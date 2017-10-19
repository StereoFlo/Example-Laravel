<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:' . User::ROLE_MODERATOR);
    }

    public function index()
    {
        return 1;
    }
}
