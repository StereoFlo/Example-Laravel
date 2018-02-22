<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use ImageResize\Image;

/**
 * Class ThumbnailController
 * @package RecycleArt\Http\Controllers
 */
class ThumbnailController extends Controller
{
    const THUMB_PATH = 'uploads/%d/work/%d/thumb';

    /**
     * @param Filesystem $filesystem
     * @param string $image
     * @return bool
     * @throws \Exception
     */
    public function get(Filesystem $filesystem, string $image): bool
    {
        $userId = $workId = $imageName = null;

        try {
            list(, $userId, , $workId, $imageName) = \explode('/', $image);
        } catch (\Exception $exception) {
            abort(404, 'something is wrong');
        }
        if (empty($userId) || empty($workId) || empty($imageName)) {
            abort(404, 'something is wrong');
        }
        $originalImagePath = \public_path(\sprintf(WorkController::WORK_PATH, $userId, $workId) . '/' . $imageName);
        $thumbnailPath = \public_path($this->getThumbPath($userId, $workId) . '/' . $imageName);

        if (!\file_exists($thumbnailPath)) {
            $image = Image::create($originalImagePath);
            $image->resizeToWidth(450);
            if (!$filesystem->isDirectory($this->getThumbPath($userId, $workId))) {
                $filesystem->makeDirectory($this->getThumbPath($userId, $workId), 0777, true, true);
            }
            $image->save($thumbnailPath, 50);
            $this->outputToBrowser($thumbnailPath);
            return true;
        }

        $this->outputToBrowser($thumbnailPath);
        return true;
    }

    /**
     * @param $thumbnailPath
     * @return self
     * @throws \Exception
     */
    private function outputToBrowser($thumbnailPath): self
    {
        $image = Image::create($thumbnailPath);
        \header('Content-Type: ' . $image->getImageInfo()->getMimeType());
        \header('Content-Length: ' . \filesize($thumbnailPath));
        \readfile($thumbnailPath);
        return $this;
    }

    /**
     * @param int $userId
     * @param $workId
     * @return string
     */
    private function getThumbPath(int $userId, $workId): string
    {
        return \public_path(\sprintf(self::THUMB_PATH, $userId, $workId));
    }
}
