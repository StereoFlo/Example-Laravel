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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAll()
    {
        return self::All();
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
     * @param int $userId
     *
     * @return array
     */
    public function getListByUserWithImages(int $userId)
    {
        $works = $this->join('work_images', 'work.id', '=', 'work_images.workId')
            ->join('users', 'work.userId', '=', 'users.id')
            ->where('userId', $userId)
            ->where('isDefault', true)
            ->where('approved', true)
            ->get()
            ->toArray();
        if (empty($works)) {
            return [];
        }
        return $works;
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function getListForHomepage(int $limit = 10)
    {
        $works = $this->join('work_images', 'work.id', '=', 'work_images.workId')
            ->join('users', 'work.userId', '=', 'users.id')
            ->inRandomOrder()
            ->limit($limit)
            ->where('isDefault', true)
            ->where('approved', true)
            ->get()
            ->toArray();
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
        $work = $this->select('users.name as userName', 'users.id as userId', 'work.*')->join('users', 'users.id', '=', 'work.userId')
            ->where('work.id', $workId)
            ->first();
        if (empty($work) || empty($work->toArray())) {
            return [];
        }
        $work = $work->toArray();
        $work['images'] = WorkImages::getbyWorkId($workId);
        $work['tags'] = (new TagsRel())->getByWork($workId);
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

    public function getList()
    {
        $result = $this->select('work.*', 'users.id as userId', 'users.name as userName')->join('users', 'users.id', '=', 'work.userId')->get();
        if (empty($result) || empty($result->toArray())) {
            return [];
        }
        return $result->toArray();
    }


    /**
     * @return array
     */
    public function getUnapproved()
    {
        $result = $this->select('work.*', 'users.id as userId', 'users.name as userName')->join('users', 'users.id', '=', 'work.userId')->where('approved', false)->get();
        if (empty($result) || empty($result->toArray())) {
            return [];
        }
        return $result->toArray();
    }

    /**
     * @param int $workId
     *
     * @return bool
     */
    public function toggleApprove(int $workId)
    {
        $work = self::find($workId);
        if (empty($work)) {
            return false;
        }
        $work->approved = $work->approved ? false : true;
        return $work->save();
    }
}
