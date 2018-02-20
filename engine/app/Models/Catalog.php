<?php

namespace RecycleArt\Models;

/**
 * Class Catalog
 * @package RecycleArt\Models
 */
class Catalog extends Model
{
    /**
     * @var string
     */
    protected $table = 'catalog';

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'description',
    ];

    /**
     * @return array
     */
    public function getList(): array
    {
        /** @var Model $res */
        $res = $this->get();
        if (!$this->checkEmptyObject($res)) {
            return [];
        }
        return $res->toArray();
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getById(int $id): array
    {
        /** @var Model $category */
        $category = self::find($id);
        if (!$this->checkEmptyObject($category)) {
            return [];
        }
        return $category->toArray();
    }

    /**
     * @param int $workId
     *
     * @return array
     */
    public function getByWorkId(int $workId): array
    {
        $res = [];
        $catsInWork = $this
            ->select('catalog.*')
            ->join('catalog_rel', 'catalog_rel.catalog_id', '=', 'catalog.id')
            ->where('catalog_rel.work_id', $workId)
            ->get();
        if (!$this->checkEmptyObject($catsInWork)) {
            $res['inWork'] = [];
            $res['notInWork'] = $this->getList();
            return $res;
        }
        $tmpCats = [];
        foreach ($catsInWork->toArray() as $cats) {
            $tmpCats[] = $cats['id'];
        }
        $catsNotInWork = $this->whereNotIn('id', $tmpCats)->get();
        $res['inWork'] = $catsInWork->toArray();
        $res['notInWork'] = !$this->checkEmptyObject($catsNotInWork) ? [] : $catsNotInWork->toArray();
        return $res;
    }

    /**
     * @param string $name
     * @param string $description
     * @param int    $parentId
     *
     * @return bool
     */
    public function addCategory(string $name, string $description = '', int $parentId = 0): bool
    {
        $this->name = $name;
        $this->description = $description;
        if (!empty($parentId)) {
            $this->parent_id = $parentId;
        }
        return $this->save();
    }

    /**
     * @param int $categoryId
     * @param int $workId
     *
     * @return bool
     */
    public function addToCategory(int $categoryId, int $workId): bool
    {
        $category = $this->where('id', $categoryId)->first();
        if (empty($category) || empty($category->toArray())) {
            return false;
        }
        $isWorkInCategory = $this->getCatalogRelation()->isWorkInCategory($categoryId, $workId);
        if ($isWorkInCategory) {
            return false;
        }

        return $this->getCatalogRelation()->addToCategory($categoryId, $workId);
    }

    /**
     * @param int   $categoryId
     * @param array $data
     *
     * @return bool
     */
    public function updateCategory(int $categoryId, array $data): bool
    {
        /** @var Model $category */
        $category = self::find($categoryId);
        if (!$this->checkEmptyObject($category)) {
            return false;
        }
        $category->name = $data['name'];
        if (isset($data['parent_id'])) {
            $category->parent_id = $data['parent_id'];
        }
        if (isset($data['description'])) {
            $category->description = $data['description'];
        }
        return $category->save();
    }

    /**
     * @param int $categoryId
     *
     * @return bool
     * @throws \Exception
     */
    public function removeCategory(int $categoryId)
    {
        /** @var Model $category */
        $category = self::find($categoryId);
        if (empty($category) || empty($category->toArray())) {
            return false;
        }
        return (bool) $category->delete() && $this->getCatalogRelation()->removeCategory($categoryId);
    }

    /**
     * @param int $categoryId
     *
     * @return array
     */
    public function getCategoryWithWorks(int $categoryId): array
    {
        /** @var Model $res */
        $res = $this
            ->select('catalog.id as categoryId', 'catalog.name as categoryName', 'catalog.description as categoryDescription', 'work.id as workId', 'workName', 'userId', 'work.description as workDescription')
            ->join('catalog_rel', 'catalog_rel.catalog_id', '=', 'catalog.id')
            ->join('work', 'work.id', '=', 'catalog_rel.work_id')
            ->join('work_images', 'work_images.workId', '=','work.id')
            ->where('catalog.id', $categoryId)
            ->where('isDefault', true)
            ->where('approved', true)
            ->get();
        if (!$this->checkEmptyObject($res)) {
            return [];
        }
        return $res->toArray();
    }
}
