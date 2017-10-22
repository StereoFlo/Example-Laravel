<?php

namespace RecycleArt\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as RequestLogin;
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
        $this->middleware('guest')->except(['logout', 'ajaxLogin']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ajaxLogin()
    {
        return view('auth.login-ajax');
    }

    /**
     * @param RequestLogin $request
     * @param              $user
     *
     * @return $this|\Illuminate\Http\JsonResponse
     */
    protected function authenticated(RequestLogin $request, $user)
    {
        if (!$request->ajax()){
            return $this;
        }
        return response()->json([
            'auth' => Auth::check(),
            'user' => $user,
            'intended' => $this->redirectPath(),
        ]);
    }
}
