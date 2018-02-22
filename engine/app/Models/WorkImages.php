<?php

namespace RecycleArt\Models;

use FileUploader\Services\FileUploaderService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use ImageResize\Image;

/**
 * Class WorkImages
 * @package RecycleArt\Models
 */
class WorkImages extends Model
{
    const WORK_PATH = 'uploads/%d/work/%d';
    const LINK_PATH = 'uploads/%d/work/%d/%s';
    const THUMB_PATH = 'uploads/%d/work/%d/thumb';

    /**
     * @var string
     */
    protected $table = 'work_images';

    /**
     * @param int $workId
     *
     * @return bool
     */
    public function removeByWorkId(int $workId): bool
    {
        return $this->where('workId', $workId)->delete();
    }

    /**
     * @return array
     */
    public function getList()
    {
        return self::all()->toArray();
    }

    /**
     * @param int $workId
     *
     * @return array
     */
    public function getbyWorkId(int $workId): array
    {
        $imgs = $this->where('workId', $workId)->get();
        if (!$this->checkEmptyObject($imgs)) {
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
    public function removeFromWork(int $workId, int $imageId): bool
    {
        $images = $this->where('id', $imageId)->where('workId', $workId)->get();
        if (!$this->checkEmptyObject($images)) {
            return false;
        }
        $isSaved = false;
        foreach ($images as $image) {
            $path = \public_path($image->link);
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
     * @param int $workId
     *
     * @return bool
     */
    public function removeAllImages(int $workId): bool
    {
        $images = $this->where('workId', $workId)->get();
        if (!$this->checkEmptyObject($images)) {
            return false;
        }
        $isSaved = false;
        foreach ($images as $image) {
            $path = \public_path($image->link);
            $isSaved = File::delete($path) && $this->where('id', $image->id)->delete();
        }
        return $isSaved;
    }

    /**
     * @deprecated
     * old native file upload
     *
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
            $work->workId = $workId;
            if (0 === $key && !$this->hasDefault($workId)) {
                $work->isDefault = true;
            }
            $newImageName = $this->uploadImage($workId, $key, $file);
            $test = \sprintf(self::LINK_PATH, Auth::id(), $workId, $newImageName);
            $work->link = $test;
            $isSaved = $work->save();
        }
        return $isSaved;
    }

    /**
     * dirty file upload
     *
     * @param int $workId
     *
     * @return bool
     * @throws \Exception
     */
    public function addImagesWithFileUploader(int $workId)
    {
        $isSaved = false;
        $path = \public_path(\sprintf(self::WORK_PATH, Auth::id(), $workId));
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
            File::makeDirectory($path . '/thumb', 0777, true, true);
        }
        $uploader = new FileUploaderService('images', ['uploadDir' => $path . DIRECTORY_SEPARATOR, 'editor' => [
            'maxWidth'  => 1024,
            'maxHeight' => 1024,
            'quality'   => 75,
        ]]); //
        $uploader->upload();

        $files = $uploader->getFileList();
        foreach ($files as $key => $file) {
            $work = new self();
            $work->workId = $workId;
            if (0 === $key && !$this->hasDefault($workId)) {
                $work->isDefault = true;
            }
            $work->link = \sprintf(self::LINK_PATH, Auth::id(), $workId, $file['name']);

            $this->makeThumb(\public_path($file['file']), \public_path(\sprintf(self::THUMB_PATH, Auth::id(), $workId)) . '/' . $file['name']);
            $work->thumb = \sprintf(self::THUMB_PATH, Auth::id(), $workId) . '/' . $file['name'];

            $isSaved = $work->save();
        }
        return $isSaved;
    }

    /**
     * @param string $originalFilePath
     * @param string $thumbFilePath
     * @return bool
     * @throws \Exception
     */
    private function makeThumb(string $originalFilePath, string $thumbFilePath): bool
    {
        return Image::create($originalFilePath)
            ->resizeToWidth(430)
            ->save( $thumbFilePath, 50);
    }

    /**
     * @param int $workId
     *
     * @return array
     */
    public function getDefault(int $workId): array
    {
        $defaultImage =  $this
            ->where('workId', $workId)
            ->where('isDefault', true)
            ->first();
        if (!$this->checkEmptyObject($defaultImage)) {
            return [];
        }
        return $defaultImage->toArray();
    }

    /**
     * @param int $workId
     * @param int $imageId
     * @return bool
     */
    public function setDefault(int $workId, int $imageId): bool
    {
        return $this->where('workId', $workId)->update(['isDefault' => false]) &&
            $this->where('workId', $workId)->where('id', $imageId)->update(['isDefault' => true]);
    }

    /**
     * @param int $workId
     *
     * @return bool
     */
    public function hasDefault(int $workId = 0): bool
    {
        if (empty($workId)) {
            return false;
        }

        if (empty($this->getDefault($workId))) {
            return false;
        }
        return true;
    }

    /**
     * @param int          $workId
     * @param int          $key
     * @param UploadedFile $file
     *
     * @return string path
     */
    protected function uploadImage(int $workId, int $key, UploadedFile $file): string
    {
        $path = \public_path(\sprintf(self::WORK_PATH, Auth::id(), $workId));
        $newImageName = \md5(\time() . $key) . '.' . \strtolower($file->getClientOriginalExtension());
        $file->move($path, $path . '/' .$newImageName);
        return $newImageName;
    }
}
