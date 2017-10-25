<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Work
 * @package RecycleArt\Models
 */
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
    public function getListByUserId(int $userId): array
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
        $work = $this->join('users', 'users.id', '=', 'work.userId')
            ->where('work.id', $workId)
            ->first();
        if (empty($work)) {
            return [];
        }
        $images = WorkImages::getInstance()->where('workId', $workId)->get();
        if (!empty($images)) {
            $images = $images->toArray();
        }
        $work = $work->toArray();
        $work['images'] = empty($images) ? null : $images;

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

    /**
     * @param int   $workId
     * @param array $data
     *
     * @return int
     */
    public function updateOrSave(int $workId = 0, array $data): int
    {
        $work = null;
        if (!empty($workId)) {
            $work = self::find($workId);
        }
        if (empty($work)) {
            $work = new self();
        }
        $work->workName = $data['workName'];
        $work->description = $data['description'];
        $work->userId = $data['userId'];
        $work->save();
        return $work->id ?: 0;
    }

}
