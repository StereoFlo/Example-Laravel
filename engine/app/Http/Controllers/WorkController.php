<?php

namespace RecycleArt\Http\Controllers;

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
    const WORK_PATH = 'uploads/$d/work/%d';

    /**
     * WorkController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param Work $work
     *
     * @return View
     */
    public function getList(Work $work): View
    {
        $works = $work->getListByUserId(Auth::id());
        return view('work.list', [
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
        $categories = $catalog->getList();
        $materials = $material->getList();
        return view('work.form', [
            'categories' => $categories,
            'materials' => $materials,
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
        $workId = $work->updateOrSave($workId, [
            'workName'    => $request->post('workName'),
            'description' => $request->post('description'),
            'userId'      => Auth::id(),
        ]);
        if (!empty($request->file('images'))) {
            $workImages->addImamges($request->file('images'), $workId);
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
        return Redirect::to(route('workShow', ['id' => $workId]));
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return int
     */
    public function remove(Request $request, int $id)
    {
        $workPath = public_path(sprintf(self::WORK_PATH, Auth::id(), $id));
        if (Work::getInstance()->removeById($id) && WorkImages::getInstance()->removeByWorkId($id) && (new TagsRel())->deleteByWork($id)) {
            File::cleanDirectory($workPath);
            rmdir($workPath);
            $request->session()->flash('addWorkResult', __('work.addWorkRemovedSuccess'));
            return Redirect::to(route('cabinetIndex'));
        }
        $request->session()->flash('addWorkResult', __('work.addWorkRemovedError'));
        return Redirect::to(route('cabinetIndex'));
    }

    /**]
     * @param Request    $request
     * @param WorkImages $workImages
     * @param int        $workId
     * @param int        $imageId
     *
     * @return mixed
     */
    public function removeImageFromWork(Request $request, WorkImages $workImages, int $workId, int $imageId)
    {
        $isSaved = $workImages->deleteImageFromWork($workId, $imageId);
        if ($isSaved) {
            $request->session()->flash('results', 'Изображение удалено');
            return Redirect::to(route('workEdit', ['id' => $workId]));
        }
        $request->session()->flash('results', 'Что-то пошло не так =(');
        return Redirect::to(route('workEdit', ['id' => $workId]));
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit(Work $work, int $id)
    {
        $work = $work->getById($id);
        if ($work['userId'] !== Auth::id()) {
            abort(401, __('workNotFound'));
        }
        if (empty($work)) {
            abort(404, __('workNotFound'));
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
            abort(404, __('work.workNotFound'));
        }
        if (!$work['approved']) {
            if ($request->user()->hasAnyRole([User::ROLE_MODERATOR, User::ROLE_ADMIN]) || $work['userId'] === Auth::id()) {
                return view('work.show', ['work' => $work, 'isLiked' => $isLiked]);
            }
            abort(401);
        }

        return view('work.show', ['work' => $work, 'isLiked' => $isLiked]);
    }

    /**
     * @param CatalogRel $catalogRel
     * @param int        $workId
     * @param int        $catId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromCategory(CatalogRel $catalogRel, int $workId, int $catId)
    {
        $res = (bool) $catalogRel->removeFromCategory($catId, $workId);
        return response()->json([
            'isRemoved' => $res
        ]);
    }

    /**
     * @param MaterialRel $materialRel
     * @param int         $workId
     * @param int         $materialId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeMaterialFromWork(MaterialRel $materialRel, int $workId, int $materialId)
    {
        $res = (bool) $materialRel->removeFromWork($workId, $materialId);
        return response()->json([
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
        if (session()->has('work' . $id)) {
            return response()->json([
                'isLiked' => false,
            ]);
        }
        $work->where('id', $id)->increment('likes');
        session(['work' . $id => true]);
        return response()->json([
            'isLiked' => true,
        ]);
    }
}
