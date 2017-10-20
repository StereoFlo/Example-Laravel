<?php

namespace RecycleArt\Http\Controllers;

use RecycleArt\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function workAddProcess(Request $request)
    {
        var_dump($request);
    }

    public function workRemove($id)
    {

    }

    public function workEdit($id)
    {

    }

    public function workShow()
    {

    }
}
