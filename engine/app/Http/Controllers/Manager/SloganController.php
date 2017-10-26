<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\Slogan as SloganModel;

/**
 * Class Slogan
 * @package RecycleArt\Http\Controllers\Manager
 */
class SloganController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $slogan = (new SloganModel())->getSlogan();
        return view('manager.slogan.form', ['content' => $slogan['content']]);
    }

    public function update(Request $request)
    {
        $content = $request->input('content');
        if (empty($content)) {
            $request->session()->flash('sloganUpdate', 'Содержимое слогана не может быть пустым');
            return Redirect::to(route('sloganIndex'));
        }

        $isSaved = (new SloganModel())->updateSlogan($content);
        if (!$isSaved) {
            $request->session()->flash('sloganUpdate', 'Что-то пошло не так при обновлении слоганаБ смотри логи');
            return Redirect::to(route('sloganIndex'));
        }
        $request->session()->flash('sloganUpdate', 'Все обновлено!');
        return Redirect::to(route('sloganIndex'));
    }
}
