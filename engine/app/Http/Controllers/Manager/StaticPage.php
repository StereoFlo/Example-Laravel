<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\StaticPage as StaticPageModel;

/**
 * Class StaticPage
 * @package RecycleArt\Http\Controllers\Manager
 */
class StaticPage extends Controller
{
    /**
     * @return Factory|View
     */
    public function getList()
    {
        $pageList = StaticPageModel::getInstance()->getList();
        return view('manager.staticPage.list', ['pages' => $pageList]);
    }

    /**
     * @return Factory|View
     */
    public function makeNew()
    {
        return view('manager.staticPage.form');
    }

    /**
     * todo необходимо записывать в сессию результат
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function process(Request $request)
    {
        StaticPageModel::getInstance()->updateOrMake($request);
        return Redirect::to(route('managerPageList'));
    }

    public function remove(string $slug)
    {
        return StaticPageModel::getInstance()->removePage($slug);
    }

    /**
     * @param string $slug
     *
     * @return Factory|View
     */
    public function update(string $slug)
    {
        $page = StaticPageModel::getInstance()->getBy($slug);
        if (empty($page)) {
            abort(404, 'page not found');
        }
        return view('manager.staticPage.form', ['page' => $page]);
    }
}
