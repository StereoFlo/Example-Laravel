<?php

namespace RecycleArt\Models;

/**
 * Class RoleUser
 * @package RecycleArt\Models
 */
class RoleUser extends Model
{
    /**
     * @var string
     */
    protected $table = 'role_user';

    /**
     * @var array
     */
    protected $fillable = [
        'role_id', 'user_id',
    ];

    /**
     * @param int $userId
     * @param int $roleId
     *
     * @return bool
     */
    public function enableRole(int $userId, int $roleId): bool
    {
        $role = $this->where('user_id', $userId)->where('role_id', $roleId)->get();
        if (!$this->checkEmptyObject($role)) {
            return $this->create([
                'role_id' => $roleId,
                'user_id' => $userId,
            ]);
        }
        return false;
    }

    /**
     * @param int $userId
     * @param string $roleId
     *
     * @return bool
     */
    public function enableRoleByName(int $userId, string $roleId): bool
    {
        $getRole = $this->getRole()->getByName($roleId);
        if (empty($getRole)) {
            return false;
        }
        $role = $this->where('user_id', $userId)->where('role_id', $getRole['id'])->get();
        if (!$this->checkEmptyObject($role)) {
            return $this->create([
                'role_id' => $getRole['id'],
                'user_id' => $userId,
            ]);
        }
        return false;
    }

    /**
     * @param int $userId
     * @param int $roleId
     *
     * @return bool
     */
    public function disableRole(int $userId, int $roleId = 0): bool
    {
        return $this->where('user_id', $userId)->where('role_id', $roleId)->delete();
    }

    /**
     * @param int $userId
     *
     * @return bool
     */
    public function disableAllRole(int $userId): bool
    {
        return $this->where('user_id', $userId)->delete();
    }
}
