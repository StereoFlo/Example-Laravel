<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\Catalog as CatalogModel;

/**
 * Class CatalogController
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class CatalogController extends Controller
{

    /**
     * @param CatalogModel $catalog
     *
     * @return JsonResponse
     */
    public function getList(CatalogModel $catalog): JsonResponse
    {
        $list = $catalog->getList();
        return JsonResponse::create($list);
    }

    /**
     * @param CatalogModel $catalog
     * @param int          $categoryId
     *
     * @return JsonResponse
     */
    public function show(CatalogModel $catalog, int $categoryId): JsonResponse
    {
        return JsonResponse::create($catalog->getById($categoryId));
    }

    /**
     * @param CatalogModel $catalog
     * @param Request      $request
     *
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function process(CatalogModel $catalog, Request $request): JsonResponse
    {
        $this->validate($request, [
            'name'        => 'required|string',
            'description' => 'string',
        ]);

        $id = $request->post('id', 0);
        $name = $request->post('name');
        $description = $request->post('description');

        if (empty($id)) {
            $catalog->addCategory($name, $description);
            return new JsonResponse([
                'success' => true
            ]);
        }
        $catalog->updateCategory($id, [
            'name' => $name,
            'description' => $description
        ]);
        return JsonResponse::create([
            'success' => true
        ]);
    }

    /**
     * @param CatalogModel $catalog
     * @param int $id
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function remove(CatalogModel $catalog, int $id): JsonResponse
    {
        $catalog->removeCategory($id);
        return JsonResponse::create([
            'success' => true
        ]);
    }
}