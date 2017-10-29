<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this
            ->belongsToMany('RecycleArt\Models\TagsRel')
            ->withTimestamps();
    }

    /**
     * @param string $tagName
     *
     * @return array
     */
    public function getByName(string $tagName)
    {
        $tag = $this->where('tag', $tagName)->first();
        if (empty($tag) || empty($tag->toArray())) {
            return [];
        }
        return $tag->toArray();
    }

    /**
     * @param string $tagName
     *
     * @return int
     */
    public function add(string $tagName)
    {
        $tag = new self();
        $tag->tag = $tagName;
        $tag->save();
        return $tag->id ?: 0;
    }

}


