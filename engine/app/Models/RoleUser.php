<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

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
     * @return RoleUser
     */
    public static function getInstance()
    {
        return new self();
    }

    /**
     * @param int $userId
     * @param int $roleId
     *
     * @return bool
     */
    public function enableRole(int $userId, int $roleId)
    {
        $role = $this->where('user_id', $userId)->where('role_id', $roleId)->get()->toArray();
        if (empty($role)) {
            return $this->create([
                'role_id' => $roleId,
                'user_id' => $userId,
            ]);
        }
        return false;
    }

    public function disableRole(int $userId, int $roleId)
    {
        $role = $this->where('user_id', $userId)->where('role_id', $roleId)->get()->toArray();
        if (empty($role)) {
            return false;
        }
        return $this->where('user_id', $userId)->where('role_id', $roleId)->delete();
    }
}
