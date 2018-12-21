<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function form(\RecycleArt\Models\Settings $settings)
    {
        return view('manager.settings.form', ['settings' => $settings->getAllArray()]);
    }

    public function process(Request $request, \RecycleArt\Models\Settings $settings)
    {
        $settings->store($request->all());
        return Redirect::to(route('managerSettingsForm'));
    }
}
