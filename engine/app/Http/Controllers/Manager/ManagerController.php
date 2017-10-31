<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Support\Facades\View;
use RecycleArt\Http\Controllers\Controller;
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
     */
    public function __construct()
    {
        View::share('userCount', User::getAll()->count());
        View::share('workCount', \count((new Work())->getUnapproved()));
        View::share('newsCount', \RecycleArt\Models\News::getAll()->count());
    }
}
