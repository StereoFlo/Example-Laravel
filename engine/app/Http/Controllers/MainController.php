<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

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
