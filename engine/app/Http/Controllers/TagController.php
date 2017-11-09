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
     * @var TagsRel
     */
    protected $tagRelModel;

    /**
     * TagController constructor.
     */
    public function __construct()
    {
        $this->tagRelModel = new TagsRel();
    }

    /**
     * @param int $workId
     * @param int $tagId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFromWork(int $workId, int $tagId)
    {
        $isDeleted = $this->tagRelModel->deleteFromWork($workId, $tagId);
        return response()->json([
            'isDeleted' => (bool) $isDeleted,
        ]);
    }
}
