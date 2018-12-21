<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\Material as MaterialModel;

/**
 * Class MaterialController
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class MaterialController extends Controller
{
    /**
     * @param MaterialModel $material
     *
     * @return JsonResponse
     */
    public function getList(MaterialModel $material): JsonResponse
    {
        $list = $material->getList();

        return JsonResponse::create($list);
    }

    /**
     * @param Request       $request
     * @param MaterialModel $material
     *
     * @return mixed
     */
    public function process(Request $request, MaterialModel $material): JsonResponse
    {
        $id          = $request->post('id', false);
        $name        = $request->post('name', false);
        $file        = $request->file('file');
        $description = $request->post('description', '');
        if (!$id) {
            $id = \time();
        }

        $path = \public_path(self::MATERIAL_URL);
        $newImageName = $id . '.' . \strtolower($file->getClientOriginalExtension());
        $file->move($path, $newImageName);
        $url = self::MATERIAL_URL . $newImageName;

        $material->makeNew($id, $name, $url, $description);
        return JsonResponse::create([
            'success' => true
        ]);
    }

    /**
     * @param MaterialModel $material
     * @param int           $id
     *
     * @return JsonResponse
     */
    public function remove(MaterialModel $material, int $id): JsonResponse
    {
        $material->removeBy($id);
        return JsonResponse::create([
            'success' => true
        ]);
    }
}