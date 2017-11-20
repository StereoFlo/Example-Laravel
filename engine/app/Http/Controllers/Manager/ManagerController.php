<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Support\Facades\View;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\News;
use RecycleArt\Models\User;
use RecycleArt\Models\Work;

/**
 * Class ManagerController
 * @package RecycleArt\Http\Controllers\Manager
 */
class ManagerController extends Controller
{
    /**
     * ManagerController constructor.
     *
     * @param Work $work
     * @param User $user
     */
    public function __construct(Work $work, User $user)
    {
        View::share('userCount', $user->getAll()->count());
        View::share('workCount', \count($work->getUnapprovedList()));
        View::share('newsCount', News::getAll()->count());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return \view('manager.shared.index');
    }
}
