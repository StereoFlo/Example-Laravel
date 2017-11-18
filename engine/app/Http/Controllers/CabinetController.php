<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Models\User;
use RecycleArt\Models\Work;

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
     * @param Work $work
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Work $work)
    {
        return view('cabinet.index', [
            'works' => $work->getListByUserId(Auth::id()),
        ]);
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
     * @param User    $user
     *
     * @return mixed
     */
    public function profileUpdate(Request $request, User $user)
    {
        if (!empty($request->file('avatar'))) {
            $this->validate($request, [
                'avatar' => 'mimes:jpeg,bmp,png',
            ]);
        }
        $user->updateProfile($request);
        $request->session()->flash('updateResult', __('cabinet.accountUpdated'));
        return Redirect::to(route('profileForm'));
    }

    /**
     * @param Request $request
     * @param User    $user
     *
     * @return int
     */
    public function removeAvatar(Request $request, User $user)
    {
        if ($user->removeAvatar()) {
            $request->session()->flash('updateResult', __('cabinet.AvatarSuccessRemoved'));
            return Redirect::to(route('profileForm'));
        }
        $request->session()->flash('updateResult', __('cabinet.AvatarErrorRemoved'));
        return Redirect::to(route('profileForm'));
    }
}
