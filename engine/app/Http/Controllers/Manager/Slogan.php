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
class Slogan extends ManagerController
{
    /**
     * this constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param SloganModel $slogan
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form(SloganModel $slogan)
    {
        $slogan = $slogan->getSlogan();
        return \view('manager.slogan.form', ['content' => $slogan]);
    }

    /**
     * @param Request     $request
     * @param SloganModel $slogan
     *
     * @return mixed
     */
    public function update(Request $request, SloganModel $slogan)
    {
        $content = $request->input('content');
        if (empty($content)) {
            $request->session()->flash('sloganUpdate', 'Содержимое слогана не может быть пустым');
            return Redirect::to(route('sloganForm'));
        }

        $isSaved = $slogan->updateSlogan($content);
        if (!$isSaved) {
            $request->session()->flash('sloganUpdate', 'Что-то пошло не так при обновлении слоганаБ смотри логи');
            return Redirect::to(route('sloganForm'));
        }
        $request->session()->flash('sloganUpdate', 'Все обновлено!');
        return Redirect::to(route('sloganForm'));
    }
}
