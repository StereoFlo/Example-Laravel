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
    public function getList()
    {
        return view('manager.work.list', ['works' => \RecycleArt\Models\Work::getInstance()->getList()]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListByAuthor(int $id)
    {
        return view('manager.work.list', ['works' => \RecycleArt\Models\Work::getInstance()->getList($id)]);
    }

    /**
     * @param int $workId
     *
     * @return array
     */
    public function approve(int $workId): array
    {
        return [
            'isApproved' => \RecycleArt\Models\Work::getInstance()->toggleApprove($workId)
        ];
    }
}
