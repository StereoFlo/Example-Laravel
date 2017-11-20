<?php

namespace RecycleArt\Http\Controllers;

use RecycleArt\Models\News;

/**
 * Class NewsController
 * @package RecycleArt\Http\Controllers
 */
class NewsController extends Controller
{
    /**
     * @var News
     */
    protected $newsModel;

    /**
     * NewsController constructor.
     *
     * @param News $news
     */
    public function __construct(News $news)
    {
        $this->newsModel = $news;
    }

    /**
     * @param int $page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function getList(int $page = 0)
    {
        $news = $this->newsModel->getList($this->newsModel->getPerPage(), $page);

        return \view('news.list', [
            'news'        => $news,
            'currentPage' => $page,
            'parPage'     => $this->newsModel->getPerPage(),
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
            \abort(404, 'News not found');
        }

        return \view('news.show', [
            'news' => $news,
        ]);
    }
}
