<?php

namespace RecycleArt\Models;

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
        $works = $this->where('userId', $userId)->get();
        if (!$this->checkEmptyObject($works)) {
            return [];
        }
        return $works->toArray();
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
            ->get();
        if (!$this->checkEmptyObject($works)) {
            return [];
        }
        return $works->toArray();
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
            ->get();
        if (!$this->checkEmptyObject($works)) {
            return [];
        }
        return $works->toArray();
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
        if (!$this->checkEmptyObject($work)) {
            return [];
        }
        $work = $work->toArray();
        $work['images'] = WorkImages::getbyWorkId($workId);
        $work['tags'] = (new TagsRel())->getByWork($workId);
        $work['categories'] = (new Catalog())->getByWorkId($workId);
        return $work;
    }

    /**
     * @param int $workId
     *
     * @return mixed
     */
    public function removeById(int $workId)
    {
        (new TagsRel())->deleteByWork($workId);
        (new CatalogRel())->removeWorkCategory($workId);
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
        $work->approved = false;
        $work->save();
        return $work->id ?: 0;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getList(int $id = 0)
    {
        $result = $this->select('work.*', 'users.id as userId', 'users.name as userName')->join('users', 'users.id', '=', 'work.userId');
        if (!empty($id)) {
            $result->where('userId', $id);
        }
        $result = $result->get();
        if (!$this->checkEmptyObject($result)) {
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
        if (!$this->checkEmptyObject($result)) {
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
        if (!$this->checkEmptyObject($work)) {
            return false;
        }
        $work->approved = $work->approved ? false : true;
        return $work->save();
    }
}
