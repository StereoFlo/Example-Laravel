<?php

namespace RecycleArt\Models;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
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
        $slf = new self();
        $imgs = self::where('workId', $workId)->get();
        if (!$slf->checkEmptyObject($imgs)) {
            return [];
        }
        return $imgs->toArray();
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
        if (!$this->checkEmptyObject($images)) {
            return false;
        }
        $isSaved = false;
        foreach ($images as $image) {
            $path = public_path($image->link);
            $isSaved = File::delete($path) && $this->where('id', $imageId)->where('workId', $workId)->delete();
            if ($image->isDefault) {
                $minId = $this->select('id')->where('workId', $workId)->min('id');
                if ($minId) {
                    $isSaved = $this->where('id', $minId)->update(['isDefault' => true]);
                }
            }
        }
        return $isSaved;
    }

    /**
     * @param UploadedFile[] $files
     * @param int $workId
     *
     * @return bool
     */
    public function addImages(array $files, $workId): bool
    {
        $isSaved = false;
        if (empty(Auth::id())) {
            return $isSaved;
        }
        if (empty($files)) {
            return $isSaved;
        }
        foreach ($files as $key => $file) {
            $work = new self();
            $path = \public_path('uploads/' . Auth::id() . '/work/' . $workId);
            $newImageName = \md5(\time() . $key) . '.' . \strtolower($file->getClientOriginalExtension());
            $file->move($path, $newImageName);
            $work->workId = $workId;
            if (0 === $key && !$this->hasDefault($workId)) {
                $work->isDefault = true;
            }
            $work->link = '/uploads/' . Auth::id() . '/work/' . $workId . '/' . $newImageName;
            $isSaved = $work->save();
        }
        return $isSaved;
    }

    /**
     * @param int $workId
     *
     * @return array
     */
    public function getDefault(int $workId)
    {
        $defaultImage =  $this->where('workId', $workId)->where('isDefault', true)->first();
        if (!$this->checkEmptyObject($defaultImage)) {
            return [];
        }
        return $defaultImage->toArray();
    }

    /**
     * @param int $workId
     *
     * @return bool
     */
    public function hasDefault(int $workId = 0)
    {
        if (empty($workId)) {
            return false;
        }
        $hasDefault = $this->where('workId', $workId)->where('isDefault', true)->get();
        if (!$this->checkEmptyObject($hasDefault)) {
            return false;
        }
        return true;
    }
}
