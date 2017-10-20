<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Support\Facades\Auth;

/**
 * Class WorkController
 * @package App\Http\Controllers
 */
class WorkController extends Controller
{
    /**
     * @var Work
     */
    protected $work;

    public function __construct()
    {
        $this->work = new Work();
    }

    public function workList()
    {
        $userId = Auth::user()->id;
        $works = $this->work->getAllByUser($userId);
        return view('work.list', ['works' => $works]);
    }

    public function workAdd()
    {

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
