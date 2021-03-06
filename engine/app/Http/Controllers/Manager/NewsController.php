<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\News as NewsModel;

/**
 * Class NewsController
 * @package RecycleArt\Http\Controllers\Manager
 */
class NewsController extends ManagerController
{
    const NEWS_PER_PAGE = 15;

    /**
     * @var NewsModel
     */
    protected $newsModel;

    /**
     * NewsController constructor.
     *
     * @param NewsModel $news
     */
    public function __construct(NewsModel $news)
    {
        $this->newsModel = $news;
        parent::__construct();
    }

    /**
     * @param int $page
     *
     * @return Factory|\Illuminate\View\View
     */
    public function getList(int $page = 0)
    {
        $news = $this->newsModel->getList(self::NEWS_PER_PAGE, $page);
        return \view('manager.news.list', [
            'news'        => $news,
            'currentPage' => $page,
            'parPage'     => self::NEWS_PER_PAGE,
            'newsCount'   => NewsModel::All()->count(),
        ]);
    }

    /**
     * @return Factory|\Illuminate\View\View
     */
    public function makeNew()
    {
        return \view('manager.news.form');
    }

    public function update(int $id)
    {
        $news = $this->newsModel->getById($id);
        if (empty($news)) {
            \abort(404, 'Новость не найдена');
        }
        return \view('manager.news.form', ['news' => $news]);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function process(Request $request)
    {
        $id      = $request->input('id');
        $name    = $request->input('name');
        $content = $request->input('content');
        if (empty($id)) {
            $this->newsModel->make($name, $content);
            $request->session()->flash('newsFlash', 'Успешно добавлено!');
            return Redirect::to(route('newsList'));
        }
        $this->newsModel->updateById($id, $name, $content);
        $request->session()->flash('newsFlash', 'Успешно обновлено!');
        return Redirect::to(route('newsList'));
    }

    /**
     * @param Request $request
     * @param int     $id
     *
     * @return mixed
     */
    public function delete(Request $request, int $id)
    {
        $request->session()->flash('newsFlash', 'Успешно удалено!');
        $this->newsModel->deleteById($id);
        return Redirect::to(route('newsList'));
    }
}
