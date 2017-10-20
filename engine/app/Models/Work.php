<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'work';

    /**
     * @param $userId
     *
     * @return array
     */
    public function getAllByUser(int $userId): array
    {
        $works = $this->where('userId', $userId)->get()->toArray();
        if (empty($works)) {
            return [];
        }
        return $works;
    }

    /**
     * @param int $workId
     *
     * @return array
     */
    public function getById(int $workId): array
    {
        $work = $this->where('workId', $workId)->get()->toArray();
        if (empty($work)) {
            return [];
        }
        return $work;
    }

}
