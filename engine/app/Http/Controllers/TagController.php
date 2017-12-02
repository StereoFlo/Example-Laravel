<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Http\Request;
use RecycleArt\Models\TagsRel;
use RecycleArt\Models\Work;

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
     *
     * @param TagsRel $tagsRel
     */
    public function __construct(TagsRel $tagsRel)
    {
        $this->tagRelModel = $tagsRel;
    }

    /**
     * @param Request $request
     * @param Work    $work
     * @param int     $workId
     * @param int     $tagId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFromWork(Request $request, Work $work, int $workId, int $tagId)
    {
        if (!$this->checkWork($work, $request, $workId)) {
            abort(401);
        }
        $isDeleted = $this->tagRelModel->deleteFromWork($workId, $tagId);
        return \response()->json([
            'isDeleted' => (bool) $isDeleted,
        ]);
    }
}
