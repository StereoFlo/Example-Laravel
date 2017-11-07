<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package RecycleArt\Models
 */
class Role extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this
            ->belongsToMany('RecycleArt\Models\User')
            ->withTimestamps();
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function getByName(string $name)
    {
        $role = $this->where('name', $name)->first();
        if (empty($role) || empty($role->toArray())) {
            return [];
        }
        return $role->toArray();
    }
}
