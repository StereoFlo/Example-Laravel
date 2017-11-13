<?php

namespace RecycleArt\Models;

/**
 * Class StaticPage
 * @package RecycleArt\Models
 */
class StaticPage extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'slug';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @param string $slug
     *
     * @return array
     */
    public function getBy(string $slug)
    {
        $page = self::find($slug);
        if (!$this->checkEmptyObject($page)) {
            return [];
        }
        return $page->toArray();
    }
}
