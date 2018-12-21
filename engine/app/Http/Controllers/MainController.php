<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use RecycleArt\Models\News;
use RecycleArt\Models\Settings;
use RecycleArt\Models\Work;

/**
 * Class MainController
 * @package RecycleArt\Http\Controllers
 */
class MainController extends Controller
{
    private $settings;

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
     * @param Settings $settings
     * @param News $news
     * @param Work $work
     */
    public function __construct(Settings $settings, News $news, Work $work)
    {
        $this->settings = $settings;
        $this->news     = $news;
        $this->work     = $work;
    }

    /**
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('main.index', [
            'slogan'           => $this->settings->getOneFromArray('slogan'),
            'generalPageBlock' => $this->settings->getOneFromArray('generalPageBlock'),
            'news'             => $this->news->getList(),
            'works'            => $this->work->getListForHomepage($this->work->getPerPage()),
        ]);
    }
}
