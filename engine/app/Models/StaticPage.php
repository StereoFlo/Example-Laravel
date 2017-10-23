<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StaticPage
 * @package RecycleArt\Models
 */
class StaticPage extends Model
{
    protected $table = 'static_page';

    /**
     * @return StaticPage
     */
    public static function getInstance()
    {
        return new self();
    }
}
