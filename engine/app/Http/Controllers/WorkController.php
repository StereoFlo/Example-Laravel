<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
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
    /**
     * @var Work
     */
    protected $work;

    /**
     * WorkController constructor.
     */
    public function __construct()
    {
        $this->work = new Work();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $userId = Auth::id();
        $works = $this->work->getListByUserId($userId);
        return view('work.list', ['works' => $works]);
    }

    /**
     * @return View
     */
    public function add(): View
    {
        return view('work.form');
    }

    /**
     * Process for add/edit work
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function process(Request $request)
    {
        $workId = $request->post('workId') ?: 0;
        $workId = Work::getInstance()->updateOrSave($workId, [
            'workName'    => $request->post('workName'),
            'description' => $request->post('description'),
            'userId'      => Auth::id(),
        ]);
        if (!empty($request->file('images'))) {
            WorkImages::getInstance()->addImamges($request->file('images'), $workId);
        }
        if (!empty($request->post('tags'))) {
            (new Tags())->addTagsToWork($request->post('tags'), $workId);
        }
        $request->session()->flash('addWorkResult', __('work.addProcessSuccess'));
        return Redirect::to('/cabinet/work/'. $workId . '');
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return int
     */
    public function remove(Request $request, int $id)
    {
        $workPath = public_path('uploads/' . Auth::id() . '/work/' . $id);
        if (Work::getInstance()->removeById($id) && WorkImages::getInstance()->removeByWorkId($id) && (new TagsRel())->deleteByWork($id)) {
            File::cleanDirectory($workPath);
            rmdir($workPath);
            $request->session()->flash('addWorkResult', __('work.addWorkRemovedSuccess'));
            return Redirect::to('/cabinet/');
        }
        $request->session()->flash('addWorkResult', __('work.addWorkRemovedError'));
        return Redirect::to('/cabinet/');
    }

    /**]
     * @param Request $request
     * @param int     $workId
     * @param int     $imageId
     *
     * @return mixed
     */
    public function removeImageFromWork(Request $request, int $workId, int $imageId)
    {
        $isSaved = WorkImages::getInstance()->deleteImageFromWork($workId, $imageId);
        if ($isSaved) {
            $request->session()->flash('results', 'Изображение удалено');
            return Redirect::to('/cabinet/work/' . $workId . '/edit');
        }
        $request->session()->flash('results', 'Что-то пошло не так =(');
        return Redirect::to('/cabinet/work/' . $workId . '/edit');
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit(int $id)
    {
        $work = (new Work)->getById($id);
        if ($work['userId'] !== Auth::id()) {
            abort(404, __('workNotFound'));
        }
        if (empty($work)) {
            abort(404, __('workNotFound'));
        }
        return \view('work.form', ['work' => $work]);
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return View
     */
    public function show(Request $request, int $id): View
    {
        $work = new Work();
        $work = $work->getById($id);
        if (empty($work)) {
            abort(404, __('work.workNotFound'));
        }
        if (!$work['approved']) {
            if ($request->user()->hasAnyRole([User::ROLE_MODERATOR, User::ROLE_ADMIN]) || $work['userId'] === Auth::id()) {
                return view('work.show', ['work' => $work]);
            }
            abort(401);
        }
        return view('work.show', ['work' => $work]);
    }
}
