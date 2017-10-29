<?php

namespace RecycleArt\Http\Controllers;

use RecycleArt\Models\TagsRel;

/**
 * Class TagController
 * @package RecycleArt\Http\Controllers
 */
class TagController extends Controller
{
    /**
     * @param int $workId
     * @param int $tagId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFromWork(int $workId, int $tagId)
    {
        $isDeleted = (new TagsRel())->deleteFromWork($workId, $tagId);
        return response()->json([
            'isDeleted' => $isDeleted,
        ]);
    }
}
