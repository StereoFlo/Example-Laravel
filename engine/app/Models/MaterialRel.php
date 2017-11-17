<?php

namespace RecycleArt\Models;

/**
 * Class MaterialRel
 * @package RecycleArt\Models
 */
class MaterialRel extends Model
{
    /**
     * @param int $workId
     * @param int $materialId
     *
     * @return bool
     */
    public function addToWork(int $workId, int $materialId)
    {
        $this->work_id = $workId;
        $this->material_id = $materialId;
        return $this->save();
    }

    /**
     * @param int $workId
     * @param int $materialId
     *
     * @return mixed
     */
    public function removeFromWork(int $workId, int $materialId)
    {
        return $this->where('work_id', $workId)->where('material_id', $materialId)->delete();
    }

    /**
     * @param int $workId
     *
     * @return array
     */
    public function getListByWork(int $workId)
    {
        $list = $this->where('work_id', $workId)->get();
        if (!$this->checkEmptyObject($list)) {
            return [];
        }
        return $list;
    }
}
