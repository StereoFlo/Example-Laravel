<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\View\View;
use RecycleArt\Models\StaticPage;

/**
 * Class StaticPageController
 * @package RecycleArt\Http\Controllers
 */
class StaticPageController extends Controller
{
    /**
     * @param StaticPage $staticPage
     * @param string     $id
     *
     * @return View
     */
    public function getPage(StaticPage $staticPage, string $id)
    {
        $page = $staticPage->getBy($id);
        if (empty($page)) {
            \abort(404, 'Static page not found');
        }
        return \view('static_page.main', ['page' => $page]);
    }
}
