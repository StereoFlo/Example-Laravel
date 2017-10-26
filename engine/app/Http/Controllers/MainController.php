<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use RecycleArt\Models\Slogan;

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
        return view('welcome', ['slogan' => $slogan]);
    }
}
