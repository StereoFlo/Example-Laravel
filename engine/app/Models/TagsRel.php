<?php

namespace RecycleArt\Models;

/**
 * Class TagsRel
 * @package RecycleArt\Models
 */
class TagsRel extends Model
{
    /**
     * @param int $workId
     *
     * @return array
     */
    public function getByWork(int $workId): array
    {
        $tags = $this->select('tags.tag', 'tags.id', 'tags_rels.workId')->join('tags', 'tags.id', '=', 'tags_rels.tagId')->where('tags_rels.workId', $workId)->get();
        if (!$this->checkEmptyObject($tags)) {
            return [];
        }
        return $tags->toArray();
    }

    /**
     * @param int $workId
     *
     * @return bool
     */
    public function deleteByWork(int $workId): bool
    {
        return $this->where('tags_rels.workId', $workId)->delete();
    }

    /**
     * @param int $workId
     * @param int $tagId
     *
     * @return bool
     */
    public function deleteFromWork(int $workId, int $tagId): bool
    {
        return $this->where('workId', $workId)->where('tagId', $tagId)->delete();
    }

    /**
     * @param int $tagId
     *
     * @return bool
     */
    public function deleteByTag(int $tagId): bool
    {
        return $this->where('tags_rels.tagId', $tagId)->delete();
    }

    /**
     * @param $tagId
     * @param $workId
     *
     * @return bool
     */
    public function addToWork(int $tagId, int $workId): bool
    {
        $this->tagId = $tagId;
        $this->workId = $workId;
        return $this->save();
    }
}
