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
    const WORK_LIMIT = 15;

    /**
     * @var Slogan
     */
    private $slogan;

    /**
     * @var News
     */
    private $news;

    /**
     * @var Work
     */
    private $work;

    /**
     * MainController constructor.
     */
    public function __construct()
    {
        $this->slogan = new Slogan();
        $this->news = new News();
        $this->work = new Work();
    }

    /**
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('main.index', [
            'slogan' => $this->slogan->getSlogan(),
            'news'   => $this->news->getList(),
            'works'  => $this->work->getListForHomepage(self::WORK_LIMIT),
        ]);
    }
}
