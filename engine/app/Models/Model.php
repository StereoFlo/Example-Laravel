<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model as EModel;

/**
 * Class Model
 * @package RecycleArt\Models
 */
class Model extends EModel
{
    /**
     * @param object|null $obj
     *
     * @return bool
     */
    protected function checkEmptyObject($obj = null)
    {
        if (empty($obj)) {
            return false;
        }
        if (!method_exists($obj, 'toArray')) {
            return false;
        }
        if (empty($obj->toArray())) {
            return false;
        }
        return true;
    }
}
