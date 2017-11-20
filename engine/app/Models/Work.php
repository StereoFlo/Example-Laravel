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
        $works = $this
            ->select('work.*', 'users.id as userId', 'users.name as userName')
            ->join('users', 'users.id', '=', 'work.userId')
            ->where('userId', $userId)->get();
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
        $works = $this
            ->join('work_images', 'work.id', '=', 'work_images.workId')
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
        $work = $this
            ->select('users.name as userName', 'users.id as userId', 'work.*')
            ->join('users', 'users.id', '=', 'work.userId')
            ->where('work.id', $workId)
            ->first();
        if (!$this->checkEmptyObject($work)) {
            return [];
        }
        $work = $work->toArray();
        $work['images'] = $this->getWorkImages()->getbyWorkId($workId);
        $work['tags'] = $this->getTagsRelation()->getByWork($workId);
        $work['categories'] = $this->getCatalog()->getByWorkId($workId);
        $work['materials'] = $this->getMaterial()->getListByWork($workId);
        return $work;
    }

    /**
     * @param int $workId
     *
     * @return mixed
     */
    public function removeById(int $workId)
    {
        $this->getMaterialRelation()->removeWork($workId);
        $this->getTagsRelation()->deleteByWork($workId);
        $this->getCatalogRelation()->removeWorkCategory($workId);
        $this->getWorkImages()->removeAllImages($workId);
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
     * @param array $categories
     * @param int   $offset
     *
     * @return array
     */
    public function getListByCategory(array $categories, int $offset = 0)
    {
        if (empty($offset)) {
            $res = $this
                ->join('catalog_rel', 'catalog_rel.work_id', '=', 'work.id')
                ->join('work_images', 'work_images.workId', '=', 'work.id')
                ->join('users', 'work.userId', '=', 'users.id')
                ->take($this->perPage)
                ->whereIn('catalog_id', $categories)
                ->where('isDefault', true)
                ->where('work.approved', true)
                ->get();
        } else {
            $res = $this
                ->join('catalog_rel', 'catalog_rel.work_id', '=', 'work.id')
                ->join('work_images', 'work.id', '=', 'work_images.workId')
                ->join('users', 'work.userId', '=', 'users.id')
                ->skip($offset*$this->perPage)
                ->take($this->perPage)
                ->whereIn('catalog_id', $categories)
                ->where('isDefault', true)
                ->where('work.approved', true)
                ->get();
        }
        if (!$this->checkEmptyObject($res)) {
            return [];
        }
        $result = [];
        foreach ($res->toArray() as $work) {
            if (isset($result[$work['workId']])) {
                continue;
            }
            $result[$work['workId']] = $work;
        }
        return $result;
    }

    /**
     * @param array $categories
     *
     * @return int
     */
    public function getCountByCategory(array $categories)
    {
        $res = $this
            ->join('catalog_rel', 'catalog_rel.work_id', '=', 'work.id')
            ->join('work_images', 'work.id', '=', 'work_images.workId')
            ->whereIn('catalog_id', $categories)
            ->where('isDefault', true)
            ->where('work.approved', true)
            ->get();
        if (!$this->checkEmptyObject($res)) {
            return 0;
        }
        return $res->count();
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function getListRecentlyLiked(int $limit = 3)
    {
        $res = $this
            ->select('work.*', 'users.id as userId', 'users.name as userName', 'work_images.link')
            ->join('work_images', 'work.id', '=', 'work_images.workId')
            ->join('users', 'users.id', '=', 'work.userId')
            ->orderBy('likes', 'DESC')
            ->take($limit)
            ->where('work_images.isDefault', true)
            ->where('work.approved', true)
            ->get();
        if (!$this->checkEmptyObject($res)) {
            return [];
        }
        return $res->toArray();
    }

    /**
     * @return array
     */
    public function getList()
    {
        $result = $this
            ->select('work.*', 'users.id as userId', 'users.name as userName', 'work_images.link')
            ->join('work_images', 'work.id', '=', 'work_images.workId')
            ->join('users', 'users.id', '=', 'work.userId')
            ->get();
        if (!$this->checkEmptyObject($result)) {
            return [];
        }
        return $result->toArray();
    }

    /**
     * @return array
     */
    public function getListForManager()
    {
        $result = $this
            ->select('work.*', 'users.id as userId', 'users.name as userName')
            ->join('users', 'users.id', '=', 'work.userId')
            ->get();
        if (!$this->checkEmptyObject($result)) {
            return [];
        }
        return $result->toArray();
    }

    /**
     * @param int $offset
     *
     * @return array
     */
    public function getListForGallery(int $offset = 0)
    {
        $result = $this
            //->select('work.*', 'users.id as userId', 'users.name as name', 'work_images.link')
            ->join('work_images', 'work.id', '=', 'work_images.workId')
            ->join('users', 'users.id', '=', 'work.userId')
            ->skip($offset*$this->perPage)
            ->take($this->perPage)
            ->where('work_images.isDefault', true)
            ->where('work.approved', true)
            ->get();
        if (!$this->checkEmptyObject($result)) {
            return [];
        }
        return $result->toArray();
    }

    /**
     * @return int
     */
    public function getCountForGallery()
    {
        $result = $this
            ->select('work.*', 'users.id as userId', 'users.name as userName', 'work_images.link')
            ->join('work_images', 'work.id', '=', 'work_images.workId')
            ->join('users', 'users.id', '=', 'work.userId')
            ->where('work_images.isDefault', true)
            ->where('work.approved', true)
            ->get();
        if (!$this->checkEmptyObject($result)) {
            return 0;
        }
        return $result->count();
    }

    /**
     * @param bool $approve
     *
     * @return array
     */
    public function getUnapprovedList(bool $approve = false)
    {
        $result = $this
            ->select('work.*', 'users.id as userId', 'users.name as userName')
            ->join('users', 'users.id', '=', 'work.userId')
            ->where('work.approved', $approve)
            ->get();
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
