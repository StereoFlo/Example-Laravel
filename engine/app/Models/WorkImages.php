<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

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

    /**
     * @param int $workId
     *
     * @return mixed
     */
    public static function getbyWorkId(int $workId)
    {
        return self::where('workId', $workId)->get();
    }

    /**
     * @param int $workId
     * @param int $imageId
     *
     * @return bool
     */
    public function deleteImageFromWork(int $workId, int $imageId)
    {
        $images = $this->where('id', $imageId)->where('workId', $workId)->get();
        if (empty($images) || empty($images->toArray())) {
            return false;
        }

        $isSaved = false;
        foreach ($images as $image) {
            $path = public_path($image->link);
            $isSaved = File::delete($path) && $this->where('id', $imageId)->where('workId', $workId)->delete();
            if ($image->isDefault) {
                $minId = $this->select('id')->where('workId', $workId)->min('id')->get();
                $isSaved = $this->where('id', $minId->id)->update(['isDefault' => true]);
            }
        }
        return $isSaved;
    }
}
