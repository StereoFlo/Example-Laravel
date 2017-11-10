<?php

namespace RecycleArt\Models;

/**
 * Class StaticPage
 * @package RecycleArt\Models
 */
class StaticPage extends Model
{
    /**
     * @param int $id
     *
     * @return array
     */
    public function getBy(int $id)
    {
        $page = self::find($id);
        if (!$this->checkEmptyObject($page)) {
            return [];
        }
        return $page->toArray();
    }
}
