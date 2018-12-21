<?php

namespace RecycleArt\Http\Controllers\Manager\Api;

use Illuminate\Http\JsonResponse;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\Role;
use RecycleArt\Models\RoleUser;
use RecycleArt\Models\User as UserModel;
use RecycleArt\Models\Work;

/**
 * Class UserController
 * @package RecycleArt\Http\Controllers\Manager\Api
 */
class UserController extends Controller
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
    public function show(Role $role, Work $work, UserModel $user, int $userId): JsonResponse
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

    /**
     * @param RoleUser $roleUser
     * @param int      $userId
     * @param int      $roleId
     *
     * @return JsonResponse
     */
    public function addRole(RoleUser $roleUser, int $userId, int $roleId): JsonResponse
    {
        return JsonResponse::create([
            'success' => $roleUser->enableRole($userId, $roleId)
        ]);
    }

    /**
     * @param RoleUser $roleUser
     * @param int      $userId
     * @param int      $roleId
     *
     * @return JsonResponse
     */
    public function removeRole(RoleUser $roleUser, int $userId, int $roleId): JsonResponse
    {
        return JsonResponse::create([
            'success' => $roleUser->disableRole($userId, $roleId)
        ]);
    }

    /**
     * @param UserModel $user
     * @param Work      $work
     * @param int       $id
     *
     * @return JsonResponse
     */
    public function removeUser(UserModel $user, Work $work, int $id): JsonResponse
    {
        $userToRemove = $user->findOrFail($id);
        $works = $work->getListByUserId($userToRemove->id);
        foreach ($works as $workItem) {
            $work->removeById($workItem['id']);
        }
        return JsonResponse::create([
            'success' => $user->removeUser($id)
        ]);
    }
}