<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RecycleArt\Models\Settings as SettingsModel;

/**
 * Class SettingsController
 * @package RecycleArt\Http\Controllers\Manager
 */
class SettingsController extends ManagerController
{
    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param SettingsModel $settings
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form(SettingsModel $settings)
    {
        return view('manager.settings.form', ['settings' => $settings->getAllArray()]);
    }

    /**
     * @param Request       $request
     * @param SettingsModel $settings
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(Request $request, SettingsModel $settings)
    {
        $settings->store($request->all());
        return Redirect::to(route('managerSettingsForm'));
    }
}
