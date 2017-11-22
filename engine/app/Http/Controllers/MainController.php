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
     *
     * @param Slogan $slogan
     * @param News   $news
     * @param Work   $work
     */
    public function __construct(Slogan $slogan, News $news, Work $work)
    {
        $this->slogan = $slogan;
        $this->news = $news;
        $this->work = $work;
    }

    /**
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('main.index', [
            'slogan' => $this->slogan->getSlogan(),
            'news'   => $this->news->getList(),
            'works'  => $this->work->getListForHomepage($this->work->getPerPage()),
        ]);
    }
}
