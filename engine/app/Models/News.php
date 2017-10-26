<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

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
     * @param int    $limit
     * @param int    $offset
     * @param string $orderBy
     *
     * @return array
     */
    public function getNews(int $limit = 2, int $offset = 0, $orderBy = 'created_at'): array
    {
        $news = null;
        if (empty($limit)) {
            $news = $this->orderBy($orderBy, 'DESC')->get();
        } else {
            $news = $this->skip($offset*$limit)->take($limit)->orderBy($orderBy, 'DESC')->get();
        }
        if (empty($news)) {
            return [];
        }
        return $news->toArray();
    }

    /**
     * @param string $name
     * @param string $content
     *
     * @return mixed
     */
    public function make(string $name, string $content)
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
    public function getById(int $id)
    {
        $res = $this->where('id', $id)->first();
        if (empty($res)) {
            return [];
        }
        return $res->toArray();
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function deleteById(int $id)
    {
        return $this->where('id', $id)->delete();
    }

    /**
     * @param int    $id
     * @param string $name
     * @param string $content
     *
     * @return mixed
     */
    public function updateById(int $id, string $name, string $content)
    {
        return $this->where('id', $id)->update([
            'name'    => $name,
            'content' => $content,
        ]);
    }
}
