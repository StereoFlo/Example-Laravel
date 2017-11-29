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
    public function addToWork(int $workId, array $materialIds): bool
    {
        $recordsToSave = [];
        foreach ($materialIds as $materialId)
        {
            $recordsToSave[] = [
                'work_id' => $workId,
                'material_id' => $materialId,
            ];
        }
        return (bool) self::insert($recordsToSave);
    }

    /**
     * @param int $materialId
     *
     * @return bool
     */
    public function removeMaterial(int $materialId): bool
    {
        return (bool) $this->where('material_id', $materialId)->delete();
    }

    /**
     * @param int $workId
     *
     * @return bool
     */
    public function removeWork(int $workId): bool
    {
        return (bool) $this->where('work_id', $workId)->delete();
    }

    /**
     * @param int $workId
     * @param int $materialId
     *
     * @return mixed
     */
    public function removeFromWork(int $workId, int $materialId): bool
    {
        return (bool) $this->where('work_id', $workId)->where('material_id', $materialId)->delete();
    }
}
