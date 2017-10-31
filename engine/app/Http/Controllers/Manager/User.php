<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Support\Facades\Redirect;
use RecycleArt\Http\Controllers\Controller;
use RecycleArt\Models\Role;
use RecycleArt\Models\RoleUser;
use RecycleArt\Models\User as UserModel;
use RecycleArt\Models\Work;

/**
 * Class User
 * @package RecycleArt\Http\Controllers\Manager
 */
class User extends ManagerController
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $users = UserModel::getAll();
        return view('manager.user.list', ['users' => $users]);
    }

    public function show(int $userId)
    {
        $user = UserModel::find($userId);
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
        $works = Work::getInstance()->getListByUserId($user->id);
        return view('manager.user.show', ['user' => $user->toArray(), 'userRoles' => $userRoles, 'roles'=> $roles, 'works' => $works]);
    }

    /**
     * @param int $userId
     * @param int $roleId
     *
     * @return int
     */
    public function addRole(int $userId, int $roleId)
    {
        RoleUser::getInstance()->enableRole($userId, $roleId);
        return Redirect::to(route('managerUserShow', ['userId' =>$userId]));
    }

    /**
     * @param int $userId
     * @param int $roleId
     *
     * @return int
     */
    public function removeRole(int $userId, int $roleId)
    {
        RoleUser::getInstance()->disableRole($userId, $roleId);
        return Redirect::to(route('managerUserShow', ['userId' =>$userId]));
    }
}
