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
     * @return Catalog
     */
    public static function getInstance()
    {
        return new self();
    }

    /**
     * @return array
     */
    public function getList()
    {
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
    public function getById(int $id)
    {
        $category = self::find($id);
        if (!$this->checkEmptyObject($category)) {
            return [];
        }
        return $category->toArray();
    }

    /**
     * @param string $name
     * @param string $descr
     * @param int    $parentId
     *
     * @return bool
     */
    public function addCategory(string $name, string $descr = '', int $parentId = 0)
    {
        $instance = new self();
        $instance->name = $name;
        $instance->description = $descr;
        if (!empty($parentId)) {
            $instance->parent_id = $parentId;
        }
        return $instance->save();
    }

    /**
     * @param int $categoryId
     * @param int $workId
     *
     * @return bool
     */
    public function addToCategory(int $categoryId, int $workId)
    {
        $category = $this->where('id', $categoryId)->first();
        if (empty($category) || empty($category->toArray())) {
            return false;
        }
        $isWorkInCategory = (new CatalogRel())->isWorkInCategory($categoryId, $workId);
        if ($isWorkInCategory) {
            return false;
        }

        return (new CatalogRel())->addToCategory($categoryId, $workId);
    }

    /**
     * @param int   $categoryId
     * @param array $data
     *
     * @return bool
     */
    public function updateCategory(int $categoryId, array $data)
    {
        $category = self::find($categoryId);
        if (empty($category) || empty($category->toArray())) {
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
     */
    public function removeCategory(int $categoryId)
    {
        $category = self::find($categoryId);
        if (empty($category) || empty($category->toArray())) {
            return false;
        }
        return $category->delete() && (new CatalogRel())->removeCategory($categoryId);
    }

    /**
     * @param int $categoryId
     *
     * @return array
     */
    public function getCategoryWithWorks(int $categoryId)
    {
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
