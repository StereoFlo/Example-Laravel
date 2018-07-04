<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    /**
     * @param Request       $request
     * @param MaterialModel $material
     *
     * @return mixed
     */
    public function process(Request $request, MaterialModel $material)
    {
        $id          = $request->post('id', false);
        $name        = $request->post('name', false);
        $file        = $request->file('file');
        $description = $request->post('description', '');
        if (!$id) {
            $id = \time();
        }
        $url = '/uploads/materials/';
        $path = \public_path($url);
        $newImageName = $id . '.' . \strtolower($file->getClientOriginalExtension());
        $file->move($path, $newImageName);
        $url = $url . $newImageName;

        $material->makeNew($id, $name, $url, $description);
        return new JsonResponse([
            'success' => true
        ]);
    }
}