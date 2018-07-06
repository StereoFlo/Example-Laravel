<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use RecycleArt\Models\Catalog as CatalogModel;

/**
 * Class Catalog
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class Catalog extends Controller
{
    /**
     * @param CatalogModel $catalog
     *
     * @return JsonResponse
     */
    public function getList(CatalogModel $catalog): JsonResponse
    {
        $list = $catalog->getList();
        return new JsonResponse(['categories' => $list]);
    }
}