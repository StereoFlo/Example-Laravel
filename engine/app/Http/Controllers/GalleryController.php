<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Http\Request;
use RecycleArt\Models\Catalog;
use RecycleArt\Models\Work;

/**
 * Class GalleryController
 * @package RecycleArt\Http\Controllers
 */
class GalleryController extends Controller
{
    /**
     * @var array
     */
    protected $categoryList = [];

    /**
     * @var array
     */
    protected $recentlyLiked = [];

    /**
     * @var Work
     */
    protected $work;

    /**
     * GalleryController constructor.
     */
    public function __construct()
    {
        $this->categoryList = (new Catalog())->getList();
        $this->recentlyLiked = (new Work())->getListRecentlyLiked();
        $this->work = new Work();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return \view('gallery.index', [
            'categories'    => $this->categoryList,
            'recentlyLiked' => $this->recentlyLiked,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getWorks(Request $request)
    {
        $categories = $request->get('categories', []);
        $page = $request->get('page', 0);
        if (empty($categories)) {
            $list = $this->work->getListForGallery($page);
            $workCount = $this->work->getCountForGallery();
        } else {
            $list = $this->work->getListByCategory($categories, $page);
            $workCount = $this->work->getCountByCategory($categories);
        }
        return view('gallery.ajax.works', [
            'list' => $list,
            'currentPage' => $page,
            'parPage'     => $this->work->getPerPage(),
            'workCount'   => $workCount,
        ]);
    }
}
