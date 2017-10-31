<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use RecycleArt\Http\Controllers\Controller;

/**
 * Class Work
 * @package RecycleArt\Http\Controllers\Manager
 */
class Work extends ManagerController
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUnapprovedList()
    {
        return view('manager.work.unapprovedList', ['works' => \RecycleArt\Models\Work::getInstance()->getUnapproved()]);
    }
}
