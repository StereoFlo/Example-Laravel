<?php

namespace RecycleArt\Http\Controllers;

use FileUploader\Services\FileUploaderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use RecycleArt\Models\Catalog;
use RecycleArt\Models\CatalogRel;
use RecycleArt\Models\Material;
use RecycleArt\Models\MaterialRel;
use RecycleArt\Models\Tags;
use RecycleArt\Models\TagsRel;
use RecycleArt\Models\User;
use RecycleArt\Models\Work;
use RecycleArt\Models\WorkImages;

/**
 * Class WorkController
 * @package RecycleArt\Http\Controllers
 */
class WorkController extends Controller
{
    const WORK_PATH = 'uploads/%d/work/%d';

    /**
     * @param Work $work
     *
     * @return View
     */
    public function getList(Work $work): View
    {
        $works = $work->getListByUserId(Auth::id());
        return \view('work.list', [
            'works' => $works,
        ]);
    }

    /**
     * @param Catalog  $catalog
     * @param Material $material
     *
     * @return View
     */
    public function add(Catalog $catalog, Material $material): View
    {
        return view('work.form', [
            'categories' => $catalog->getList(),
            'materials' => $material->getList(),
        ]);
    }

    /**
     * Process for add/edit work
     *
     * @param Request     $request
     * @param Work        $work
     * @param WorkImages  $workImages
     * @param Tags        $tags
     * @param CatalogRel  $catalogRel
     * @param MaterialRel $materialRel
     *
     * @return mixed
     */
    public function process(Request $request, Work $work, WorkImages $workImages, Tags $tags, CatalogRel $catalogRel, MaterialRel $materialRel)
    {
        $workId = $request->post('workId') ?: 0;
        // todo make a method for code below
        if (!empty($workId) && $request->post('fileuploader-list-images')) {
            $filesArray = \json_decode($request->post('fileuploader-list-images'), true);
            if (!empty($filesArray)) {
                foreach ($filesArray as $file) {
                    if (isset($file['editor'])) {
                        $fileLink = \explode('/', $file['file']);
                        $imageFile = \end($fileLink);
                        $filePath = \public_path(\sprintf(self::WORK_PATH, Auth::id(), $workId)) . DIRECTORY_SEPARATOR . $imageFile;
                        FileUploaderService::resize($filePath, null, null, null, (isset($file['editor']['crop']) ? $file['editor']['crop'] : null), 75, (isset($file['editor']['rotation']) ? $file['editor']['rotation'] : null));
                    }
                }
            }
        }
        if (!empty($request->file('images'))) {
            try {
                $this->validate($request, [
                    'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]);
            } catch (\Exception $exception) {
                $request->session()->flash('addWorkResult', $exception->getMessage());
                return Redirect::to(\route('workAdd'));
            }
            $workId = $work->updateOrSave($workId, [
                'workName'    => $request->post('workName'),
                'description' => $request->post('description'),
                'userId'      => Auth::id(),
            ]);
            //$workImages->addImages($request->file('images'), $workId);
            $workImages->addImagesWithFileUploader($workId);
        }
        if (!empty($request->post('tags'))) {
            $tags->addTagsToWork($request->post('tags'), $workId);
        }
        if (!empty($request->post('categories'))) {
            $catalogRel->addToCategory($request->post('categories'), $workId);
        }
        if (!empty($request->post('materials'))) {
            $materialRel->addToWork($workId, $request->post('materials'));
        }
        $request->session()->flash('addWorkResult', __('work.addProcessSuccess'));
        return Redirect::to(\route('workShow', ['id' => $workId]));
    }

    /**
     * @param Request    $request
     * @param Work       $work
     * @param WorkImages $workImages
     * @param TagsRel    $tagsRel
     * @param int        $id
     *
     * @return int
     */
    public function remove(Request $request, Work $work, WorkImages $workImages, TagsRel $tagsRel, int $id)
    {
        if (!$this->checkWork($work, $request, $id)) {
            abort(401);
        }
        $workPath = \public_path(\sprintf(self::WORK_PATH, Auth::id(), $id));
        $tagsRel->deleteByWork($id);
        $workImages->removeByWorkId($id);
        $work->removeById($id);

        File::cleanDirectory($workPath);
        if (\is_dir($workPath)) {
            \rmdir($workPath);
        }
        $request->session()->flash('addWorkResult', __('work.addWorkRemovedSuccess'));
        return Redirect::to(\route('cabinetIndex'));
    }

    /**]
     * @param Request    $request
     * @param WorkImages $workImages
     * @param Work       $work
     * @param int        $workId
     * @param int        $imageId
     *
     * @return mixed
     */
    public function removeImageFromWork(Request $request, WorkImages $workImages, Work $work, int $workId, int $imageId)
    {
        if (!$this->checkWork($work, $request, $workId)) {
            abort(401);
        }
        $isSaved = $workImages->removeFromWork($workId, $imageId);
        if ($isSaved) {
            if (!$request->ajax()) {
                $request->session()->flash('results', 'Изображение удалено');
                return Redirect::to(\route('workEdit', ['id' => $workId]));
            }
            return [
                'isDeleted' => true,
                'data' => [
                    'imageId' => $imageId,
                ]
            ];
        }
        if (!$request->ajax()) {
            $request->session()->flash('results', 'Что-то пошло не так =(');
            return Redirect::to(\route('workEdit', ['id' => $workId]));
        }
        return [
            'isDeleted' => false,
            'data' => [
                'imageId' => $imageId,
            ]
        ];
    }

    /**
     * @param Request $request
     * @param Work    $work
     * @param int     $id
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit(Request $request, Work $work, int $id)
    {
        if (!$this->checkWork($work, $request, $id)) {
            abort(401);
        }
        $work = $work->getById($id);
        if (empty($work)) {
            \abort(404, __('workNotFound'));
        }
        return \view('work.form', ['work' => $work]);
    }

    /**
     * @param Request $request
     * @param Work    $work
     * @param int     $id
     *
     * @return View
     */
    public function show(Request $request, Work $work, int $id): View
    {
        $work = $work->getById($id);
        $isLiked = session()->has('work' . $id);
        if (empty($work)) {
            \abort(404, __('work.workNotFound'));
        }
        if (!$work['approved']) {
            if ($request->user()->hasAnyRole([User::ROLE_MODERATOR, User::ROLE_ADMIN]) || $work['userId'] === Auth::id()) {
                return view('work.show', ['work' => $work, 'isLiked' => $isLiked]);
            }
            \abort(401);
        }

        return view('work.show', ['work' => $work, 'isLiked' => $isLiked]);
    }

    /**
     * @param Request    $request
     * @param Work       $work
     * @param CatalogRel $catalogRel
     * @param int        $workId
     * @param int        $catId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromCategory(Request $request, Work $work, CatalogRel $catalogRel, int $workId, int $catId)
    {
        if (!$this->checkWork($work, $request, $workId)) {
            abort(401);
        }
        $res = (bool) $catalogRel->removeFromCategory($catId, $workId);
        return \response()->json([
            'isRemoved' => $res
        ]);
    }

    /**
     * @param Request     $request
     * @param Work        $work
     * @param MaterialRel $materialRel
     * @param int         $workId
     * @param int         $materialId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeMaterialFromWork(Request $request, Work $work, MaterialRel $materialRel, int $workId, int $materialId)
    {
        if (!$this->checkWork($work, $request, $workId)) {
            abort(401);
        }

        $res = (bool) $materialRel->removeFromWork($workId, $materialId);
        return \response()->json([
            'isRemoved' => $res
        ]);
    }

    /**
     * @param Work $work
     * @param int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function setLike(Work $work, int $id)
    {
        if (\session()->has('work' . $id)) {
            return \response()->json([
                'isLiked' => false,
            ]);
        }
        $work->where('id', $id)->increment('likes');
        \session(['work' . $id => true]);
        return \response()->json([
            'isLiked' => true,
        ]);
    }
}
