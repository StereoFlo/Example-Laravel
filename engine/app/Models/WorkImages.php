<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkImages
 * @package RecycleArt\Models
 */
class WorkImages extends Model
{
    protected $table = 'workImages';

    /**
     * @return WorkImages
     */
    public static function getInstance()
    {
        return new self();
    }
}
