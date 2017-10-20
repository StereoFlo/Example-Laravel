<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkImages
 * @package RecycleArt\Models
 */
class WorkImages extends Model
{
    /**
     * @var string
     */
    protected $table = 'work_images';

    /**
     * @return WorkImages
     */
    public static function getInstance()
    {
        return new self();
    }

    /**
     * @param int $workId
     *
     * @return mixed
     */
    public function removeByWorkId(int $workId)
    {
        return $this->where('workId', $workId)->delete();
    }
}
