<?php

namespace RecycleArt\Http\Controllers;

use RecycleArt\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return 'Hello world!';
    }

    public function userList()
    {
        $users = User::getInstance()->getAll();
        return view('admin.userList', ['users' => $users]);
    }
}
