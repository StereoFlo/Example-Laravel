<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use RecycleArt\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function workList()
    {
        $userId = Auth::user()->id;
        $works = $this->work->getAllByUser($userId);
        return view('work.list', ['works' => $works]);
    }

    /**
     * @return View
     */
    public function workAdd(): View
    {
        return view('work.add');
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function workAddProcess(Request $request)
    {
        $user = Auth::user();
        $this->work->workName = $request->post('workName');
        $this->work->description = $request->post('description');
        $this->work->userId = $user->id;
        $isSaved = $this->work->save();
        $workId = $this->work->id;

        if (!empty($request->file('images'))) {
            $this->validate($request, [
                'avatar' => 'mimes:jpeg,bmp,png',
            ]);
            /** @var UploadedFile[] $files */
            $files = $request->file('images');
            foreach ($files as $key => $file) {
                $path = public_path('uploads/' . $user->id . '/work/' . $workId);
                $file->move($path, $file->getClientOriginalName());
                $workImages = WorkImages::getInstance();
                $workImages->workId = $this->work->id;
                if (0 === $key) {
                    $workImages->isDefault = true;
                }
                $workImages->link = '/uploads/' . $user->id . '/work/' . $workId . '/' . $file->getClientOriginalName();
                $isSaved = $workImages->save();
            }
        }
        if (!$isSaved) {
            $request->session()->flash('addWorkResult', 'Something is wrong.');
            return Redirect::to('/cabinet/work/new');
        }
        $request->session()->flash('addWorkResult', 'Added successfully!');
        return Redirect::to('/cabinet/work');
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return int
     */
    public function workRemove(Request $request, int $id)
    {
        if (Work::getInstance()->removeById($id) && WorkImages::getInstance()->removeByWorkId($id)) {
            $request->session()->flash('addWorkResult', 'Removed successfully!');
            return Redirect::to('/cabinet/work');
        }
        $request->session()->flash('addWorkResult', 'Something is wrong.');
        return Redirect::to('/cabinet/work');
    }


    public function workEdit(int $id)
    {

    }

    /**
     * @param int $id
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function workShow(int $id): View
    {
        $work = new Work();
        $work = $work->getById($id);
        if (empty($work)) {
            abort(404, 'Work not found');
            return []; //stub
        }
        return view('work.show', ['work' => $work]);
    }
}
