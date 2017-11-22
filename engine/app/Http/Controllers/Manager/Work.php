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
     * @var \RecycleArt\Models\Work
     */
    protected $work;

    /**
     * User constructor.
     *
     * @param \RecycleArt\Models\Work $work
     */
    public function __construct(\RecycleArt\Models\Work $work)
    {
        $this->work = $work;
        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        return \view('manager.work.list', ['works' => $this->work->getListForManager()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListUnapproved()
    {
        return \view('manager.work.list', ['works' => $this->work->getByApprove(false)]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListApproved()
    {
        return \view('manager.work.list', ['works' => $this->work->getByApprove(true)]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListByAuthor(int $id)
    {
        return \view('manager.work.list', ['works' => $this->work->getListByUserId($id)]);
    }

    /**
     * @param int $workId
     *
     * @return array
     */
    public function approve(int $workId): array
    {
        return [
            'isApproved' => $this->work->toggleApprove($workId)
        ];
    }
}
