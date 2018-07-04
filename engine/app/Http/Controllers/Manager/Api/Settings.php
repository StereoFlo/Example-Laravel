<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\Settings as SettingsModel;

/**
 * Class Settings
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class Settings extends Controller
{
    /**
     * @param SettingsModel $settings
     *
     * @return JsonResponse
     */
    public function getList(SettingsModel $settings): JsonResponse
    {
        return new JsonResponse($settings->getAllArray());
    }

    /**
     * @param Request       $request
     * @param SettingsModel $settings
     *
     * @return JsonResponse
     */
    public function process(Request $request, SettingsModel $settings): JsonResponse
    {
        $settings->store($request->all());
        return new JsonResponse([
           'success' => true
        ]);
    }
}