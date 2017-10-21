<?php

namespace RecycleArt\Http\Controllers\Auth;

use RecycleArt\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->redirectTo = config('user.redirectAuth');
        $this->middleware('guest')->except('logout');
    }
}
