<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Models\Catalog as CatalogModel;

/**
 * Class Catalog
 * @package RecycleArt\Http\Controllers\Manager
 */
class Catalog extends ManagerController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $list = CatalogModel::getInstance()->getList();
        return view('manager.catalog.list', ['categories' => $list]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form(int $id = 0)
    {
        if (empty($id)) {
            return \view('manager.catalog.form');
        }
        $category = CatalogModel::getInstance()->getById($id);
        if (empty($category)) {
            abort(404, 'category has not found');
        }
        return \view('manager.catalog.form', ['category' => $category]);
    }

    public function process(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required|string',
            'description' => 'string',
        ]);

        $id = $request->post('id', 0);
        $name = $request->post('name');
        $description = $request->post('description');

        if (empty($id)) {
            CatalogModel::getInstance()->addCategory($name, $description);
            return Redirect::to(route('managerCatalogList'));
        }
        CatalogModel::getInstance()->updateCategory($id, [
            'name' => $name,
            'description' => $description
        ]);
        return Redirect::to(route('managerCatalogList'));
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function remove(int $id)
    {
        CatalogModel::getInstance()->removeCategory($id);
        return Redirect::to(route('managerCatalogList'));
    }
}
