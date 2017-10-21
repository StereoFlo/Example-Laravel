<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Contracts\View\Factory;

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
        return view('welcome');
    }
}
