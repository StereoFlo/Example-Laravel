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
     * @param int $id
     * @param int $page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(int $id = 0, int $page = 0)
    {
        if (empty($id)) {
            $list = $this->work->getListForGallery();
        } else {
            $list = $this->work->getListByCategory($id, $page);
        }

        return \view('gallery.index', [
            'categories'    => $this->categoryList,
            'recentlyLiked' => $this->recentlyLiked,
            'list'          => $list,
        ]);
    }
}
