<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RecycleArt\Http\Controllers\Controller;

/**
 * Class NewsController
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class NewsController extends Controller
{
    /**
     * @param \RecycleArt\Models\News $news
     * @param int                     $page
     *
     * @return JsonResponse
     */
    public function getList(\RecycleArt\Models\News $news, int $page = 0): JsonResponse
    {
        $news = $news->getList($news->getPerPage(), $page);
        return JsonResponse::create($news);
    }

    /**
     * @param \RecycleArt\Models\News $news
     * @param int                     $pageId
     *
     * @return JsonResponse
     */
    public function show(\RecycleArt\Models\News $news, int $pageId): JsonResponse
    {
        return JsonResponse::create($news->getById($pageId));
    }

    /**
     * @param \RecycleArt\Models\News $news
     * @param int                     $id
     *
     * @return mixed
     */
    public function delete(\RecycleArt\Models\News $news, int $id)
    {
        return JsonResponse::create([
            'success' => $news->deleteById($id)
        ]);
    }

    /**
     * @param Request                 $request
     * @param \RecycleArt\Models\News $news
     *
     * @return mixed
     */
    public function process(Request $request, \RecycleArt\Models\News $news)
    {
        $id      = $request->input('id');
        $name    = $request->input('name');
        $content = $request->input('content');
        if (empty($id)) {
            return JsonResponse::create([
                'success' => $news->make($name, $content)
            ]);
        }
        return JsonResponse::create([
            'success' => $news->updateById($id, $name, $content)
        ]);
    }
}