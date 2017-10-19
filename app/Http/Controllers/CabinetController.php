<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class CabinetController
 * @package App\Http\Controllers
 */
class CabinetController extends Controller
{
    /**
     * CabinetController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }
}
