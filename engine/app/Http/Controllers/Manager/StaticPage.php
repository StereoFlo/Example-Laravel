<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Models\StaticPage as StaticPageModel;

/**
 * Class StaticPage
 * @package RecycleArt\Http\Controllers\Manager
 */
class StaticPage extends ManagerController
{
    /**
     * @return Factory|View
     */
    public function getList(StaticPageModel $staticPage)
    {
        $pageList = $staticPage->getList();
        return \view('manager.staticPage.list', ['pages' => $pageList]);
    }

    /**
     * @return Factory|View
     */
    public function makeNew()
    {
        return \view('manager.staticPage.form');
    }

    /**
     * todo необходимо записывать в сессию результат сохранения/изменения
     *
     * @param Request         $request
     *
     * @param StaticPageModel $staticPage
     *
     * @return mixed
     */
    public function process(Request $request, StaticPageModel $staticPage)
    {
        $staticPage->updateOrMake($request);
        return Redirect::to(route('managerPageList'));
    }

    /**
     * @param StaticPageModel $staticPage
     * @param string          $slug
     *
     * @return mixed
     */
    public function remove(StaticPageModel $staticPage, string $slug)
    {
        $staticPage->removePage($slug);
        return Redirect::to(route('managerPageList'));
    }

    /**
     * @param StaticPageModel $staticPage
     * @param string          $slug
     *
     * @return Factory|View
     */
    public function update(StaticPageModel $staticPage, string $slug)
    {
        $page = $staticPage->getBy($slug);
        if (empty($page)) {
            \abort(404, 'page not found');
        }
        return \view('manager.staticPage.form', ['page' => $page]);
    }
}
