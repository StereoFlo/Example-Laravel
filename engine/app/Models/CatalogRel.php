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
     * @return self
     */
    public static function getInstance()
    {
        return new self();
    }

    /**
     * @param int $categoryId
     * @param int $workId
     *
     * @return bool
     */
    public function isWorkInCategory($categoryId, $workId)
    {
        $res = $this->where('work_id', $workId)->where('catalog_id', $categoryId)->first();
        if (!$this->checkEmptyObject($res)) {
            return false;
        }
        return true;
    }

    /**
     * @param int $categoryId
     * @param int $workId
     *
     * @return bool
     */
    public function addToCategory(int $categoryId, int $workId)
    {
        $instance = new self();
        $instance->catalog_id = $categoryId;
        $instance->work_id_id = $workId;
        return $instance->save();
    }

    /**
     * @param int $categoryId
     * @param int $workId
     *
     * @return bool
     */
    public function updateWorkCategory(int $categoryId, int $workId)
    {
        if (!$this->isWorkInCategory($categoryId, $workId)) {
            return $this->addToCategory($categoryId, $workId);
        }
        $this->catalog_id = $categoryId;
        $this->work_id_id = $workId;
        return $this->save();
    }

    /**
     * @param int $workId
     *
     * @return bool
     */
    public function removeWorkCategory(int $workId)
    {
        return $this->where('work_id', $workId)->delete();
    }

    /**
     * @param int $categoryId
     *
     * @return bool
     */
    public function removeCategory(int $categoryId)
    {
        return $this->where('catalog_id', $categoryId)->delete();
    }
}
