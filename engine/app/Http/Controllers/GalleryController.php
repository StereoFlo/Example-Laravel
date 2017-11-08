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
    protected $recentlyLiked = [];

    /**
     * GalleryController constructor.
     */
    public function __construct()
    {
        $this->categoryList = (new Catalog())->getList();
        $this->recentlyLiked = (new Work())->getListRecentlyLiked();
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = (new Work())->getListForGallery();
        return \view('gallery.index', ['categories' => $this->categoryList, 'recentlyLiked' => $this->recentlyLiked, 'list' => $list]);
    }

    public function listByCategory(int $id, int $page = 0)
    {
        $list = (new Work())->getListByCategory($id, $page);
        return \view('gallery.index', ['categories' => $this->categoryList, 'recentlyLiked' => $this->recentlyLiked, 'list' => $list]);
    }
}
