<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'settingId',
        'name',
        'value',
        'parentId',
        'hash',
        'data',
    ];
}
