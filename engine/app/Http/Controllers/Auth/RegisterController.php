<?php

namespace RecycleArt\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['ajaxRegister']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ajaxRegister()
    {
        return view('auth.ajax.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param Request $request
     *
     * @return void
     */
    protected function validator(Request $request)
    {
        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        $niceNames = [
            'name'     => 'Имя',
            'email'    => 'Email',
            'password' => 'Пароль',
        ];
        $this->validate($request, $rules, [], $niceNames);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \RecycleArt\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            //'location' => $data['location'],
            //'phone'    => $data['phone'],
            //'about'    => $data['about'],
            'email'    => $data['email'],
            'password' => \bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request)->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if ($request->ajax()) {
            return response()->json([
                'auth' => Auth::check(),
                'user' => $user,
            ]);
        }
    }
}
