<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Models\Material as MaterialModel;

/**
 * Class Material
 * @package RecycleArt\Http\Controllers\Manager
 */
class Material extends ManagerController
{
    /**
     * Material constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param MaterialModel $material
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList(MaterialModel $material)
    {
        $list = $material->getList();

        return \view('manager.material.list', ['list' => $list]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return \view('manager.material.form');
    }

    public function edit(MaterialModel $material, int $id)
    {
        $material = $material->getBy($id);
        return \view('manager.material.form', ['material' => $material]);
    }

    public function remove(MaterialModel $material, int $id)
    {
        $material->removeBy($id);
        return Redirect::to(route('managerMaterialList'));
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
        return Redirect::to(route('managerMaterialList'));
    }
}
