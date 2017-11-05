<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use RecycleArt\Models\News;
use RecycleArt\Models\Slogan;
use RecycleArt\Models\Work;

/**
 * Class MainController
 * @package RecycleArt\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        $slogan = (new Slogan())->getSlogan();
        $news = (new News())->getList();
        $works = Work::getInstance()->getListForHomepage(15);
        return view('welcome', ['slogan' => $slogan, 'news' => $news, 'works' => $works]);
    }
}
