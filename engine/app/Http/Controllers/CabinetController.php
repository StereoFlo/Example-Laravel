<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/**
 * Class CabinetController
 * @package RecycleArt\Http\Controllers
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        return view('cabinet.profile');
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->location = $request->post('location');
        $user->phone = $request->post('phone');
        $user->about = $request->post('about');

        if (!empty($request->file('avatar'))) {
            $this->validate($request, [
                'avatar' => 'mimes:jpeg,bmp,png',
            ]);
            $file = $request->file('avatar');
            $file->move(public_path('uploads/' . $user->id), 'avatar.' . $file->clientExtension());
            $user->avatar = '/uploads/' . $user->id . '/avatar.' . $file->clientExtension();
        }

        if (!empty($request->post('password'))) {
            if ($request->post('password') !== $request->post('password_confirmation')) {
                $request->session()->flash('updateResult', 'Password not match!');
                return Redirect::to('/cabinet/profile');
            }
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
        $request->session()->flash('updateResult', 'Your account has been updated!');
        return Redirect::to('/cabinet/profile');
    }
}
