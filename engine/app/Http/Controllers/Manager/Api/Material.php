<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\Material as MaterialModel;

/**
 * Class Material
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class Material extends Controller
{
    /**
     * @param MaterialModel $material
     *
     * @return JsonResponse
     */
    public function getList(MaterialModel $material): JsonResponse
    {
        $list = $material->getList();

        return new JsonResponse($list);
    }
}