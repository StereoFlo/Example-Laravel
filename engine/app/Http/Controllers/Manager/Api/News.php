<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RecycleArt\Http\Controllers\Controller;

/**
 * Class News
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class News extends Controller
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
            $news->make($name, $content);
            return JsonResponse::create([
                'success' => $news->make($name, $content)
            ]);
        }
        $news->updateById($id, $name, $content);
        return JsonResponse::create([
            'success' => $news->updateById($id, $name, $content)
        ]);
    }
}