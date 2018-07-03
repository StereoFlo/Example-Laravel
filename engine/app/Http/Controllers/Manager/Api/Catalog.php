<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RecycleArt\Http\Controllers\Controller;
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
        return new JsonResponse($list);
    }

    /**
     * @param CatalogModel $catalog
     * @param Request      $request
     *
     * @return JsonResponse
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
        return new JsonResponse([
            'success' => true
        ]);
    }

    /**
     * @param CatalogModel $catalog
     * @param int $id
     *
     * @return mixed
     * @throws \Exception
     */
    public function remove(CatalogModel $catalog, int $id)
    {
        $catalog->removeCategory($id);
        return new JsonResponse([
            'success' => true
        ]);
    }
}