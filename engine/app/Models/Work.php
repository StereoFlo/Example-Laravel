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
     * Work constructor.
     */

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
    public function getListByUserWithImages(int $userId): array
    {
        $works = $this->join('work_images', 'work.id', '=', 'work_images.workId')
            ->join('users', 'work.userId', '=', 'users.id')
            ->where('userId', $userId)
            ->where('isDefault', true)
            ->where('approved', true)
            ->orderBy('work.id', 'desc')
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
    public function getListForHomepage(int $limit = 10): array
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
        /** @var Model $work */
        $work = $this
            ->select('users.name as userName', 'users.id as userId', 'work.*')
            ->join('users', 'users.id', '=', 'work.userId')
            ->where('work.id', $workId)
            ->first();
        if (!$this->checkEmptyObject($work)) {
            return [];
        }
        $compiledWork = $work->toArray();
        $compiledWork['images'] = $this->getWorkImages()->getbyWorkId($workId);
        $compiledWork['tags'] = $this->getTagsRelation()->getByWork($workId);
        $compiledWork['categories'] = $this->getCatalog()->getByWorkId($workId);
        $compiledWork['materials'] = $this->getMaterial()->getListByWork($workId);
        return $compiledWork;
    }

    /**
     * @param int $workId
     *
     * @return bool
     */
    public function removeById(int $workId): bool
    {
        $this->getMaterialRelation()->removeWork($workId);
        $this->getTagsRelation()->deleteByWork($workId);
        $this->getCatalogRelation()->removeWorkCategories($workId);
        $this->getWorkImages()->removeAllImages($workId);
        $this->where('id', $workId)->delete();
        return true;
    }

    /**
     * @param int   $workId
     * @param array $data
     *
     * @return int
     */
    public function updateOrSave(int $workId = 0, array $data): int
    {
        if (empty($workId)) {
            $work = new self();
        } else {
            $work = self::find($workId);
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
    public function getListByCategory(array $categories, int $offset = 0): array
    {
        $result = [];
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
        foreach ($res->toArray() as $work) {
            if (empty($work) || empty($work['workId'])) {
                continue;
            }
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
    public function getCountByCategory(array $categories): int
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
    public function getListRecentlyLiked(int $limit = 4): array
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
    public function getList(): array
    {
        $result = $this
            ->select('work.*', 'users.id as userId', 'users.name as userName', 'work_images.link')
            ->join('work_images', 'work.id', '=', 'work_images.workId')
            ->join('users', 'users.id', '=', 'work.userId')
            ->orderBy('work.id', 'desc')
            ->get();
        if (!$this->checkEmptyObject($result)) {
            return [];
        }
        return $result->toArray();
    }

    /**
     * @return array
     */
    public function getListForManager(): array
    {
        $result = $this
            ->select('work.*', 'users.id as userId', 'users.name as userName')
            ->join('users', 'users.id', '=', 'work.userId')
            ->orderBy('work.id', 'desc')
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
    public function getListForGallery(int $offset = 0): array
    {
        $settings = $this->getSettings()->getOneFromArray('limitWorksForGallery');
        $this->perPage = empty($settings['setting_value']) ? 30 : $settings['setting_value'];
        $result = $this
            ->join('work_images', 'work.id', '=', 'work_images.workId')
            ->join('users', 'users.id', '=', 'work.userId')
            ->skip($offset*$this->perPage)
            ->take($this->perPage)
            ->where('work_images.isDefault', true)
            ->where('work.approved', true)
            ->orderBy('work.id', 'desc')
            ->get();
        if (!$this->checkEmptyObject($result)) {
            return [];
        }
        return $result->toArray();
    }

    /**
     * @return int
     */
    public function getCountForGallery(): int
    {
        $settings = $this->getSettings()->getOneFromArray('limitWorksForGallery');
        $this->perPage = empty($settings['setting_value']) ? 30 : $settings['setting_value'];
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
    public function getByApprove(bool $approve = false): array
    {
        /** @var Model $result */
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
    public function toggleApprove(int $workId): bool
    {
        /** @var Model $work */
        $work = $this->find($workId);
        if (!$this->checkEmptyObject($work)) {
            return false;
        }
        $work->approved = $work->approved ? false : true;
        return $work->save();
    }
}
