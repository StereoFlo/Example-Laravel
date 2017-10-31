<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\Request;
use RecycleArt\Http\Controllers\Controller;

/**
 * Class Work
 * @package RecycleArt\Http\Controllers\Manager
 */
class Work extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUnapprovedList()
    {
        return view('manager.work.unapprovedList', ['works' => \RecycleArt\Models\Work::getInstance()->getUnapproved()]);
    }
}
