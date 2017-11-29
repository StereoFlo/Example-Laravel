<?php

namespace RecycleArt\Models;

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
    public function getByName(string $name): array
    {
        $role = $this->where('name', $name)->first();
        if (!$this->checkEmptyObject($role)) {
            return [];
        }
        return $role->toArray();
    }
}
