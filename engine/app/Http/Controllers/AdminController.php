<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('role:' . User::ROLE_ADMIN);
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        return 1;
    }
}
