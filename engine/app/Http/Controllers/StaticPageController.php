<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Http\Request;
use RecycleArt\Models\StaticPage;

/**
 * Class StaticPageController
 * @package RecycleArt\Http\Controllers
 */
class StaticPageController extends Controller
{
    /**
     * @param string $id
     *
     * @return array
     */
    public function getPage(string $id)
    {
        $page = (new StaticPage())->getBy($id);
        if (empty($page)) {
            abort(404, 'Static page not found');
        }
        return view('static_page.main', ['page' => $page]);
    }
}
