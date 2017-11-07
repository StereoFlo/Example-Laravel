<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    const DELIMITER = ',';

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

    /**
     * @param string $tagsString
     * @param int    $workId
     *
     * @return bool
     */
    public function addTagsToWork(string $tagsString = '', int $workId = 0)
    {
        if (empty($tagsString) || empty($workId)) {
            return false;
        }

        $tagsArray = \explode(self::DELIMITER, $tagsString);
        if (empty($tagsArray)) {
            return false;
        }

        foreach ($tagsArray as $tag) {
            $tag = \trim($tag, ' ');
            if (empty($tag)) {
                continue;
            }
            $existingTag = $this->getByName($tag);
            if (empty($existingTag)) {
                $existingTag['id'] = $this->add($tag);
            }
            TagsRel::getInstance()->addToWork($existingTag['id'], $workId);
        }
        return true;
    }

}


