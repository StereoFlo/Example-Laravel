<?php

namespace RecycleArt\Http\Controllers\Manager;

use Illuminate\Support\Facades\Redirect;
use RecycleArt\Models\Role;
use RecycleArt\Models\RoleUser;
use RecycleArt\Models\User as UserModel;
use RecycleArt\Models\Work;

/**
 * Class UserController
 * @package RecycleArt\Http\Controllers\Manager
 */
class UserController extends ManagerController
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param UserModel $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList(UserModel $user)
    {
        $users = $user->getAll();
        return \view('manager.user.list', ['users' => $users]);
    }

    public function show(Role $role, Work $work, UserModel $user, int $userId)
    {
        $user = $user->find($userId);
        if (empty($user)) {
            abort(404, 'UserController not found');
            return []; // stub
        }
        $userRoles = $user->roles->toArray();
        $rolesIds = [];
        foreach ($userRoles as $userRole) {
            $rolesIds[] = $userRole['id'];
        }
        $roles = $role->whereNotIn('id', $rolesIds)->get()->toArray();
        $works = $work->getListByUserId($user->id);
        return \view('manager.user.show', ['user' => $user->toArray(), 'userRoles' => $userRoles, 'roles'=> $roles, 'works' => $works]);
    }

    /**
     * @param RoleUser $roleUser
     * @param int      $userId
     * @param int      $roleId
     *
     * @return int
     */
    public function addRole(RoleUser $roleUser, int $userId, int $roleId)
    {
        $roleUser->enableRole($userId, $roleId);
        return Redirect::to(route('managerUserShow', ['userId' =>$userId]));
    }

    /**
     * @param RoleUser $roleUser
     * @param int      $userId
     * @param int      $roleId
     *
     * @return int
     */
    public function removeRole(RoleUser $roleUser, int $userId, int $roleId)
    {
        $roleUser->disableRole($userId, $roleId);
        return Redirect::to(route('managerUserShow', ['userId' =>$userId]));
    }

    /**
     * @param UserModel      $user
     * @param WorkController $work
     * @param int            $id
     */
    public function removeUser(UserModel $user, Work $work, int $id)
    {
        $userToRemove = $user->findOrFail($id);
        $works = $work->getListByUserId($userToRemove->id);
        foreach ($works as $workItem) {
            $work->removeById($workItem['id']);
        }
        $user->removeUser($id);
        return Redirect::to(route('managerUserList'));
    }
}
