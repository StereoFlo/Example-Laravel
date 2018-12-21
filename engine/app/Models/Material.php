<?php

namespace RecycleArt\Models;

use Illuminate\Support\Facades\File;

/**
 * Class MaterialController
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
    public function getList(): array
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
    public function getListByWork(int $workId): array
    {
        $res = [];
        $list = $this
            ->join('material_rels', 'material_rels.material_id', '=', 'materials.id')
            ->where('work_id', $workId)
            ->get();
        if (!$this->checkEmptyObject($list)) {
            $res['inWork'] = [];
            $res['notInWork'] = $this->getList();
        }
        $tmpCats = [];
        foreach ($list->toArray() as $material) {
            $tmpCats[] = $material['material_id'];
        }
        $materialNotInWork = $this->whereNotIn('id', $tmpCats)->get();
        $res['inWork'] = $list->toArray();
        $res['notInWork'] = !$this->checkEmptyObject($materialNotInWork) ? [] : $materialNotInWork->toArray();
        return $res;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getBy(int $id): array
    {
        /** @var Model $item */
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
    public function makeNew(int $id, string $name, string $url, string $description = ''): bool
    {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->description = $description;
        return $this->save();
    }

    /**
     * @param int    $id
     * @param string $name
     * @param string $url
     * @param string $description
     *
     * @return bool
     */
    public function updateBy(int $id, string $name, string $url, string $description = ''): bool
    {
        /** @var Model $obj */
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
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function removeBy(int $id)
    {
        $file = self::find($id);
        if (!$this->checkEmptyObject($file)) {
            \abort(404);
        }
        return File::delete(\public_path($file->url)) && $file->delete() && $this->getMaterialRelation()->removeMaterial($id);
    }
}
