<?php

namespace RecycleArt\Http\Controllers;

use RecycleArt\Models\News;

/**
 * Class NewsController
 * @package RecycleArt\Http\Controllers
 */
class NewsController extends Controller
{
    const NEWS_PER_PAGE = 15;

    /**
     * @var News
     */
    protected $newsModel;

    /**
     * NewsController constructor.
     */
    public function __construct()
    {
        $this->newsModel = new News();
    }

    /**
     * @param int $page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function getList(int $page = 0)
    {
        $news = $this->newsModel->getList(self::NEWS_PER_PAGE, $page);

        return view('news.list', [
            'news'        => $news,
            'currentPage' => $page,
            'parPage'     => self::NEWS_PER_PAGE,
            'newsCount'   => News::All()->count(),
        ]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $news = $this->newsModel->getById($id);

        if (empty($news)) {
            abort(404, 'News not found');
        }

        return view('news.show', [
            'news' => $news,
        ]);
    }
}
