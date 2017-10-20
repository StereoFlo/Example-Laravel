<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    /**
     * @var string
     */
    protected $table = 'work';

    /**
     * @return Work
     */
    public static function getInstance()
    {
        return new self();
    }

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
        $work = $this->where('id', $workId)
            ->first()
            ->toArray();
        if (empty($work)) {
            return [];
        }
        $images = WorkImages::getInstance()->where('workId', $workId)->get()
            ->toArray();
        if (!empty($images)) {
            $work['images'] = null;
        }
        $work['images'] = $images;
        return $work;
    }

    /**
     * @param int $workId
     *
     * @return mixed
     */
    public function removeById(int $workId)
    {
        return $this->where('id', $workId)->delete();
    }

}
