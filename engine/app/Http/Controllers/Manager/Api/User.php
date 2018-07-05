<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\Role;
use RecycleArt\Models\User as UserModel;

/**
 * Class User
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class User extends Controller
{
    /**
     * @param UserModel $user
     *
     * @return JsonResponse
     */
    public function getList(UserModel $user): JsonResponse
    {
        $users = $user->getAll();
        return JsonResponse::create($users);
    }

    /**
     * @param Role                    $role
     * @param \RecycleArt\Models\Work $work
     * @param UserModel               $user
     * @param int                     $userId
     *
     * @return JsonResponse
     */
    public function show(Role $role, \RecycleArt\Models\Work $work, UserModel $user, int $userId): JsonResponse
    {
        $user = $user->find($userId);
        if (empty($user)) {
            abort(404, 'User not found');
        }
        $userRoles = $user->roles->toArray();
        $rolesIds = [];
        foreach ($userRoles as $userRole) {
            $rolesIds[] = $userRole['id'];
        }
        $roles = $role->whereNotIn('id', $rolesIds)->get()->toArray();
        $works = $work->getListByUserId($user->id);

        return JsonResponse::create(['user' => $user->toArray(), 'userRoles' => $userRoles, 'roles'=> $roles, 'works' => $works]);
    }
}