<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package RecycleArt\Models
 */
class Role extends Model
{
    public function users()
    {
        return $this
            ->belongsToMany('RecycleArt\Models\User')
            ->withTimestamps();
    }
}
