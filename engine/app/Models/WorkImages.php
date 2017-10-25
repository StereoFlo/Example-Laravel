<?php

namespace RecycleArt\Models;

use Illuminate\Database\Eloquent\Model;
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
                $minId = $this->select('id')->where('workId', $workId)->min('id');
                $isSaved = $this->where('id', $minId)->update(['isDefault' => true]);
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
    public function addImamges(array $files, $workId): bool
    {
        $isSaved = false;
        $user = Auth::user();
        if (empty($files)) {
            return false;
        }
        foreach ($files as $key => $file) {
            $work = new self();
            $path = \public_path('uploads/' . $user->id . '/work/' . $workId);
            $newImageName = \md5(\time() . $key) . '.' . \strtolower($file->getClientOriginalExtension());
            $file->move($path, $newImageName);
            $work->workId = $workId;
            if (0 === $key) {
                $work->isDefault = true;
            }
            $work->link = '/uploads/' . $user->id . '/work/' . $workId . '/' . $newImageName;
            $isSaved = $work->save();
        }
        return $isSaved;
    }
}
