<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Http\Controllers\WorkController;
use RecycleArt\Models\CatalogRel;
use RecycleArt\Models\TagsRel;
use RecycleArt\Models\WorkImages;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class Work
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class Work extends Controller
{
    /**
     * @param \RecycleArt\Models\Work $work
     * @param Request                 $request
     * @param int                     $page
     *
     * @return JsonResponse
     */
    public function getList(\RecycleArt\Models\Work $work, Request $request, int $page = 0)
    {
        $limit = $request->request->getInt('limit', 15);
        $offset = $request->request->getInt('offset');

        return JsonResponse::create([
            'total' => $work::all()->count(),
            'limit' => $limit,
            'items' => $work->getListForManager($limit, $offset),
        ]);
    }

    /**
     * @param Request $request
     * @param \RecycleArt\Models\Work $work
     * @param WorkImages $workImages
     * @param CatalogRel $catalogRel
     * @param TagsRel $tagsRel
     * @param Filesystem $filesystem
     * @param int $id
     *
     * @return mixed
     */
    public function remove(Request $request, \RecycleArt\Models\Work $work, WorkImages $workImages, CatalogRel $catalogRel,  TagsRel $tagsRel,Filesystem $filesystem, int $id)
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
        return JsonResponse::create([
            'success' => true
        ]);
    }

    /**
     * @param \RecycleArt\Models\Work $work
     * @param int                     $workId
     *
     * @return JsonResponse
     */
    public function approve(\RecycleArt\Models\Work $work, int $workId): JsonResponse
    {
        return JsonResponse::create([
            'success' => $work->toggleApprove($workId)
        ]);
    }
}