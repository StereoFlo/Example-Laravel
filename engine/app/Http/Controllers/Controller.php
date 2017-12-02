<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use RecycleArt\Models\User;
use RecycleArt\Models\Work;

/**
 * Class Controller
 * @package RecycleArt\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Work    $work
     * @param Request $request
     * @param int     $id
     *
     * @return bool
     */
    protected function checkWork(Work $work, Request $request, int $id): bool
    {
        $workCheck = $work->getById($id);
        if (empty($workCheck) || $workCheck['userId'] !== Auth::id() || !$request->user()->hasAnyRole([User::ROLE_MODERATOR, User::ROLE_ADMIN])) {
            return false;
        }
        return true;
    }
}
