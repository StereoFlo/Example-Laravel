<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Http\Controllers\WorkController as WorkControllerParent;
use RecycleArt\Models\CatalogRel;
use RecycleArt\Models\TagsRel;
use RecycleArt\Models\Work as WorkModel;
use RecycleArt\Models\WorkImages;

/**
 * Class WorkController
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class WorkController extends Controller
{
    /**
     * @param WorkModel $work
     * @param Request   $request
     *
     * @return JsonResponse
     */
    public function getList(WorkModel $work, Request $request): JsonResponse
    {
        $limit  = $request->get('limit', 15);
        $offset = $request->get('offset', 0);
        $test   = $request->get('test');

        return JsonResponse::create([
            'total' => $work::all()->count(),
            'limit' => $limit,
            'test'  => $test,
            'items' => $work->getListForManager($limit, $offset),
        ]);
    }

    /**
     * @param Request    $request
     * @param WorkModel  $work
     * @param WorkImages $workImages
     * @param CatalogRel $catalogRel
     * @param TagsRel    $tagsRel
     * @param Filesystem $filesystem
     * @param int        $id
     *
     * @return mixed
     */
    public function remove(Request $request, WorkModel $work, WorkImages $workImages, CatalogRel $catalogRel, TagsRel $tagsRel, Filesystem $filesystem, int $id): JsonResponse
    {
        if (!$this->checkWork($work, $request, $id)) {
            abort(401);
        }
        $workPath = \public_path(\sprintf(WorkControllerParent::WORK_PATH, Auth::id(), $id));
        $catalogRel->removeWorkCategories($id);
        $tagsRel->deleteByWork($id);
        $workImages->removeByWorkId($id);
        $work->removeById($id);
        $filesystem->cleanDirectory($workPath);
        if (\is_dir($workPath)) {
            \rmdir($workPath);
        }
        return JsonResponse::create([
            'success' => true,
        ]);
    }

    /**
     * @param WorkModel $work
     * @param int       $workId
     *
     * @return JsonResponse
     */
    public function approve(WorkModel $work, int $workId): JsonResponse
    {
        return JsonResponse::create([
            'success' => $work->toggleApprove($workId),
        ]);
    }
}