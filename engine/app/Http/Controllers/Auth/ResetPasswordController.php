<?php

namespace RecycleArt\Http\Controllers\Auth;

use RecycleArt\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * ResetPasswordController constructor.
     */
    public function __construct()
    {
        $this->redirectTo = config('user.redirectAuth');
        $this->middleware('guest');
    }
}
