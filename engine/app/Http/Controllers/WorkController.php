<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
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
        $userId = Auth::user()->id;
        $works = $this->work->getListByUserId($userId);
        return view('work.list', ['works' => $works]);
    }

    /**
     * @return View
     */
    public function add(): View
    {
        return view('work.add');
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function addProcess(Request $request)
    {
        $user = Auth::user();
        $workId = $request->post('workId') ?: 0;
        $workId = Work::getInstance()->updateOrSave($workId, [
            'workName' => $request->post('workName'),
            'description' => $request->post('description'),
            'userId' => $user->id
        ]);
        $isSaved = false;
        if (!empty($request->file('images'))) {
            $isSaved = WorkImages::getInstance()->addImamges($request->file('images'), $workId);
        }
        if (!$isSaved) {
            $request->session()->flash('addWorkResult', __('work.addProcessError'));
            return Redirect::to('/cabinet/work/new');
        }
        $request->session()->flash('addWorkResult', __('work.addProcessSuccess'));
        return Redirect::to('/cabinet/work');
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return int
     */
    public function remove(Request $request, int $id)
    {
        $user = Auth::user();
        $workPath = public_path('uploads/' . $user->id . '/work/' . $id);
        if (Work::getInstance()->removeById($id) && WorkImages::getInstance()->removeByWorkId($id)) {
            File::cleanDirectory($workPath);
            rmdir($workPath);
            $request->session()->flash('addWorkResult', __('work.addWorkRemovedSuccess'));
            return Redirect::to('/cabinet/work');
        }
        $request->session()->flash('addWorkResult', __('work.addWorkRemovedError'));
        return Redirect::to('/cabinet/work');
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
        $work = Work::find($id);
        if (empty($work)) {
            abort(404, __('workNotFound'));
        }
        $images = WorkImages::getbyWorkId($id);
        if (empty($images)) {
            $images = [];
        } else {
            $images = $images->toArray();
        }
        return \view('work.edit', ['work' => $work->toArray(), 'images' => $images]);
    }

    /**
     * @param int $id
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id): View
    {
        $work = new Work();
        $work = $work->getById($id);
        if (empty($work)) {
            abort(404, __('work.workNotFound'));
        }
        return view('work.show', ['work' => $work]);
    }
}
