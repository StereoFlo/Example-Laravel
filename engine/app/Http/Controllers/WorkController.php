<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Redirect;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function workAdd()
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

        if (!empty($request->file('images'))) {
            $this->validate($request, [
                'avatar' => 'mimes:jpeg,bmp,png',
            ]);
            /** @var UploadedFile[] $files */
            $files = $request->file('images');
            foreach ($files as $key => $file) {
                $file->move(public_path('uploads/' . $user->id . '/work/' . $this->work->id), $file->getClientOriginalName());
                $workImages = WorkImages::getInstance();
                $workImages->workId = $this->work->id;
                if (0 === $key) {
                    $workImages->isDefault = true;
                }
                $workImages->link = '/uploads/' . $user->id . '/work/' . $this->work->id . '/' . $file->getClientOriginalName();
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

    public function workRemove($id)
    {

    }

    public function workEdit($id)
    {

    }

    /**
     * @param $id
     *
     * @return array
     */
    public function workShow($id)
    {
        $work = new Work();
        $work = $work->getById($id);
        if (empty($work)) {
            abort(404, 'Work not found');
            return []; //stub
        }
        return $work;
    }
}
