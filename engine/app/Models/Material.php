<?php

namespace RecycleArt\Models;

/**
 * Class Material
 * @package RecycleArt\Models
 */
class Material extends Model
{
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'url',
    ];

    /**
     * @return array
     */
    public function getList()
    {
        $all = self::all();
        if (!$this->checkEmptyObject($all)) {
            return [];
        }
        return $all->toArray();
    }

    /**
     * @param int $workId
     *
     * @return array
     */
    public function getListByWork(int $workId)
    {
        $list = $this
            ->join('material_rels', 'material_rels.material_id', '=', 'materials.id')
            ->where('work_id', $workId)
            ->get();
        if (!$this->checkEmptyObject($list)) {
            return [];
        }
        return $list;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getBy(int $id)
    {
        $item = self::find($id);
        if (!$this->checkEmptyObject($item)) {
            return [];
        }
        return $item->toArray();
    }

    /**
     * @param int    $id
     * @param string $name
     * @param string $url
     * @param string $description
     *
     * @return bool
     */
    public function makeNew(int $id, string $name, string $url, string $description = '')
    {
        $obj = new self();
        $obj->id = $id;
        $obj->name = $name;
        $obj->url = $url;
        $obj->description = $description;
        return $obj->save();
    }

    /**
     * @param int    $id
     * @param string $name
     * @param string $url
     * @param string $description
     *
     * @return bool
     */
    public function updateBy(int $id, string $name, string $url, string $description = '')
    {
        $obj = self::find($id);
        $obj->name = $name;
        $obj->url = $url;
        $obj->description = $description;
        return $obj->save();
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function removeBy(int $id)
    {
        return $this->where('id', $id)->delete();
    }
}
