<?php

namespace RecycleArt\Models;

use Illuminate\Support\Facades\DB;

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
     * @param int $categoryId
     * @param int $offset
     *
     * @return array
     */
    public function getListByCategory(int $categoryId, int $offset = 0)
    {
        if (empty($offset)) {
            $res = $this
                ->join('catalog_rel', 'catalog_rel.work_id', '=', 'work.id')
                ->join('work_images', 'work_images.workId', '=', 'work.id')
                ->take($this->perPage)
                ->where('catalog_id', $categoryId)
                ->where('isDefault', true)
                ->where('work.approved', true)
                ->get();
        } else {
            $res = $this
                ->join('catalog_rel', 'catalog_rel.work_id', '=', 'work.id')
                ->join('work_images', 'work.id', '=', 'work_images.workId')
                ->skip($offset*$this->perPage)
                ->take($this->perPage)
                ->where('catalog_id', $categoryId)
                ->where('isDefault', true)
                ->where('work.approved', true)
                ->get();
        }
        if (!$this->checkEmptyObject($res)) {
            return [];
        }
        return $res->toArray();
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function getListRecentlyLiked(int $limit = 3)
    {
        $res = $this
            ->join('work_images', 'work.id', '=', 'work_images.workId')
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
    public function getListForGallery()
    {
        $result = $this
            ->select('work.*', 'users.id as userId', 'users.name as userName', 'work_images.link')
            ->join('work_images', 'work.id', '=', 'work_images.workId')
            ->join('users', 'users.id', '=', 'work.userId')
            ->where('work_images.isDefault', true)
            ->where('work.approved', true)
            ->get();
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
