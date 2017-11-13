<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\Request;
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

    }

    public function process(Request $request)
    {

    }

    public function remove(string $slug)
    {
        return \RecycleArt\Models\StaticPage::getInstance()->removePage($slug);
    }

    public function update(string $slug)
    {

    }
}
