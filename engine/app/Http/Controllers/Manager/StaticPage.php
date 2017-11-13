<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Http\Controllers\Controller;

class StaticPage extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $pageList = \RecycleArt\Models\StaticPage::getInstance()->getList();
        return view('manager.staticPage.list', ['pages' => $pageList]);
    }

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
        \RecycleArt\Models\StaticPage::getInstance()->updateOrMake($request);
        return Redirect::to(route('managerPageList'));
    }

    public function remove(string $slug)
    {
        return \RecycleArt\Models\StaticPage::getInstance()->removePage($slug);
    }

    /**
     * @param string $slug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(string $slug)
    {
        $page = \RecycleArt\Models\StaticPage::getInstance()->getBy($slug);
        if (empty($page)) {
            abort(404, 'page not found');
        }
        return view('manager.staticPage.form', ['page' => $page]);
    }
}
