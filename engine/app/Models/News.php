<?php

namespace RecycleArt\Models;

/**
 * Class News
 * @package RecycleArt\Models
 */
class News extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'content'];

    /**
     * @return int
     */
    public static function getNewsCount(): int
    {
        return self::All()->count();
    }

    /**
     * @param int    $limit
     * @param int    $offset
     * @param string $orderBy
     *
     * @return array
     */
    public function getList(int $limit = 2, int $offset = 0, $orderBy = 'created_at'): array
    {
        $news = null;
        if (empty($limit)) {
            $news = $this->orderBy($orderBy, 'id')->get();
        } else {
            $news = $this->skip($offset*$limit)->take($limit)->orderBy($orderBy, 'id')->get();
        }
        if (!$this->checkEmptyObject($news)) {
            return [];
        }
        return $news->toArray();
    }

    /**
     * @param string $name
     * @param string $content
     *
     * @return bool
     */
    public function make(string $name, string $content): bool
    {
        return self::create([
            'name'    => $name,
            'content' => $content,
        ]);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getById(int $id): array
    {
        $res = $this->where('id', $id)->first();
        if (!$this->checkEmptyObject($res)) {
            return [];
        }
        return $res->toArray();
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return (bool) $this->where('id', $id)->delete();
    }

    /**
     * @param int    $id
     * @param string $name
     * @param string $content
     *
     * @return bool
     */
    public function updateById(int $id, string $name, string $content): bool
    {
        return $this->where('id', $id)->update([
            'name'    => $name,
            'content' => $content,
        ]);
    }
}
