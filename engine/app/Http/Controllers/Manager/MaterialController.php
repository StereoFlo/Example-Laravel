<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use RecycleArt\Models\Material as MaterialModel;

/**
 * Class MaterialController
 * @package RecycleArt\Http\Controllers\Manager
 */
class MaterialController extends ManagerController
{
    /**
     * MaterialController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param MaterialModel $material
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function getList(MaterialModel $material)
    {
        $list = $material->getList();

        return \view('manager.material.list', ['list' => $list]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function add()
    {
        return \view('manager.material.form');
    }

    /**
     * @param MaterialModel $material
     * @param int           $id
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit(MaterialModel $material, int $id)
    {
        $material = $material->getBy($id);
        return \view('manager.material.form', ['material' => $material]);
    }

    /**
     * @param MaterialModel $material
     * @param int           $id
     *
     * @return RedirectResponse
     */
    public function remove(MaterialModel $material, int $id)
    {
        $material->removeBy($id);
        return Redirect::to(route('managerMaterialList'));
    }

    /**
     * @param Request       $request
     * @param MaterialModel $material
     *
     * @return RedirectResponse
     */
    public function process(Request $request, MaterialModel $material)
    {
        $id          = $request->post('id');
        $name        = $request->post('name');
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
        return Redirect::to(route('managerMaterialList'));
    }
}
