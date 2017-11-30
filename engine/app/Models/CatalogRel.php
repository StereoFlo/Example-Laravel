<?php

namespace RecycleArt\Models;

/**
 * Class CatalogRel
 * @package RecycleArt\Models
 */
class CatalogRel extends Model
{
    /**
     * @var string
     */
    protected $table = 'catalog_rel';

    /**
     * @var array
     */
    protected $fillable = [
        'catalog_id',
        'work_id',
    ];

    /**
     * @param int $categoryId
     * @param int $workId
     *
     * @return bool
     */
    public function isWorkInCategory(int $categoryId, int $workId): bool
    {
        $res = $this->where('work_id', $workId)->where('catalog_id', $categoryId)->first();
        if (!$this->checkEmptyObject($res)) {
            return false;
        }
        return true;
    }

    /**
     * @param int|array $category
     * @param int   $workId
     *
     * @return bool
     */
    public function addToCategory($category, int $workId): bool
    {
        switch ($category) {
            case \is_array($category):
                $isSave = false;
                foreach ($category as $cat) {
                    $instance = new self();
                    $instance->catalog_id = $cat;
                    $instance->work_id = $workId;
                    $isSave = $instance->save();
                }
                return $isSave;
            case \is_string($category):
                $instance = new self();
                $instance->catalog_id = $category;
                $instance->work_id = $workId;
                return $instance->save();
            default:
                return false;
        }
    }

    /**
     * @param int $categoryId
     * @param int $workId
     *
     * @return bool
     */
    public function updateWorkCategory(int $categoryId, int $workId): bool
    {
        if (!$this->isWorkInCategory($categoryId, $workId)) {
            return $this->addToCategory($categoryId, $workId);
        }
        $this->catalog_id = $categoryId;
        $this->work_id = $workId;
        return $this->save();
    }

    /**
     * @param int $workId
     *
     * @return bool
     */
    public function removeWorkCategory(int $workId): bool
    {
        return (bool) $this->where('work_id', $workId)->delete();
    }

    /**
     * @param int $categoryId
     * @param int $workId
     *
     * @return mixed
     */
    public function removeFromCategory(int $categoryId, int $workId): bool
    {
        return (bool) $this->where('work_id', $workId)->where('catalog_id', $categoryId)->delete();
    }


    /**
     * @param int $categoryId
     *
     * @return bool
     */
    public function removeCategory(int $categoryId): bool
    {
        return (bool) $this->where('catalog_id', $categoryId)->delete();
    }
}
