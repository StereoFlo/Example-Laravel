<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RecycleArt\Models\StaticPage as StaticPageModel;

/**
 * Class StaticPageController
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class StaticPageController
{
    /**
     * @param StaticPageModel $staticPage
     *
     * @return JsonResponse
     */
    public function getList(StaticPageModel $staticPage): JsonResponse
    {
        $pageList = $staticPage->getList();
        return JsonResponse::create($pageList);
    }

    /**
     * @param StaticPageModel $staticPage
     * @param string          $pageId
     *
     * @return JsonResponse
     */
    public function show(StaticPageModel $staticPage, string $pageId): JsonResponse
    {
        return JsonResponse::create($staticPage->getBy($pageId));
    }

    /**
     * @param StaticPageModel $staticPage
     * @param string          $slug
     *
     * @return JsonResponse
     */
    public function remove(StaticPageModel $staticPage, string $slug): JsonResponse
    {
        $staticPage->removePage($slug);
        return JsonResponse::create([
            'success' => true
        ]);
    }

    /**
     * todo необходимо записывать в сессию результат сохранения/изменения
     *
     * @param Request         $request
     * @param StaticPageModel $staticPage
     *
     * @return JsonResponse
     */
    public function process(Request $request, StaticPageModel $staticPage): JsonResponse
    {
        return JsonResponse::create([
            'success' => $staticPage->updateOrMake($request)
        ]);
    }
}