<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\Request;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\StaticPage as StaticPageModel;

/**
 * Class StaticPage
 * @package RecycleArt\Http\Controllers\Manager
 */
class StaticPage extends Controller
{
    public function getList()
    {
        return view('manager.page.list', ['pages' => StaticPageModel::All()]);
    }

    public function getById(int $id)
    {
        $page = StaticPageModel::find($id);
    }

    public function deleteById(int $id)
    {
        $page = StaticPageModel::find($id);
    }

    public function make()
    {

    }

    public function makeProcess()
    {

    }
}
