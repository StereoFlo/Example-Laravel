<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Http\Controllers\WorkController;
use RecycleArt\Models\CatalogRel;
use RecycleArt\Models\TagsRel;
use RecycleArt\Models\Work as WorkModel;
use RecycleArt\Models\WorkImages;

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
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList(Request $request)
    {
        $limit = $request->query->getInt('limit', $this->work->getPerPage());
        $offset = $request->query->getInt('page', 0);

        return \view('manager.work.list', [
            'works'       => $this->work->getListForManager($limit, $offset),
            'workCount'   => $this->work->countListForManager(),
            'currentPage' => $offset,
            'parPage'     => $this->work->getPerPage(),
        ]);
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

    /**
     * @param Request $request
     * @param WorkModel $work
     * @param WorkImages $workImages
     * @param CatalogRel $catalogRel
     * @param TagsRel $tagsRel
     * @param Filesystem $filesystem
     * @param int $id
     *
     * @return mixed
     */
    public function remove(Request $request, WorkModel $work, WorkImages $workImages, CatalogRel $catalogRel,  TagsRel $tagsRel, Filesystem $filesystem, int $id)
    {
        if (!$this->checkWork($work, $request, $id)) {
            abort(401);
        }
        $workPath = \public_path(\sprintf(WorkController::WORK_PATH, Auth::id(), $id));
        $catalogRel->removeWorkCategories($id);
        $tagsRel->deleteByWork($id);
        $workImages->removeByWorkId($id);
        $work->removeById($id);
        $filesystem->cleanDirectory($workPath);
        if (\is_dir($workPath)) {
            \rmdir($workPath);
        }
        return Redirect::to(\route('managerIndex'));
    }
}
