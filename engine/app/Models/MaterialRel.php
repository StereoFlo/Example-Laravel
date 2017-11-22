<?php

namespace RecycleArt\Models;

/**
 * Class MaterialRel
 * @package RecycleArt\Models
 */
class MaterialRel extends Model
{
    /**
     * @param int       $workId
     * @param array $materialIds
     *
     * @return bool
     */
    public function addToWork(int $workId, array $materialIds)
    {
        $isSaved = false;
        foreach ($materialIds as $materialId)
        {
            $obj = new self();
            $obj->work_id = $workId;
            $obj->material_id = $materialId;
            $isSaved = $obj->save();
        }
        return $isSaved;
    }

    /**
     * @param int $materialId
     *
     * @return mixed
     */
    public function removeMaterial(int $materialId)
    {
        return $this->where('material_id', $materialId)->delete();
    }

    /**
     * @param int $workId
     *
     * @return bool
     */
    public function removeWork(int $workId)
    {
        return $this->where('work_id', $workId)->delete();
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
}
