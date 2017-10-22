<?php

namespace RecycleArt\Http\Controllers\Manager;

use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\Role;
use RecycleArt\Models\User as UserModel;

/**
 * Class User
 * @package RecycleArt\Http\Controllers\Manager
 */
class User extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $users = UserModel::getInstance()->getAll();
        return view('manager.user.list', ['users' => $users]);
    }

    public function show(int $id)
    {
        $user = UserModel::find($id);
        if (empty($user)) {
            abort(404, 'User not found');
            return []; // stub
        }
        $userRoles = $user->roles->toArray();
        $rolesIds = [];
        foreach ($userRoles as $userRole) {
            $rolesIds[] = $userRole['id'];
        }
        $roles = Role::whereNotIn('id', $rolesIds)->get()->toArray();
        return view('manager.user.show', ['user' => $user->toArray(), 'userRoles' => $userRoles, 'roles'=> $roles]);
    }
}
