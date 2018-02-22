<?php

namespace RecycleArt\Http\Controllers;

use Illuminate\Support\Facades\File;
use ImageResize\Image;

/**
 * Class ThumbnailController
 * @package RecycleArt\Http\Controllers
 */
class ThumbnailController extends Controller
{
    const THUMB_PATH = 'uploads/%d/work/%d/thumb';

    /**
     * @param string $image
     * @return bool|Image|string
     * @throws \Exception
     */
    public function get(string $image)
    {
        try {
            list(, $userId, , $workId, $imageName) = \explode('/', $image);
        } catch (\Exception $exception) {
            abort(404, 'something is wrong');
        }
        if (empty($userId) || empty($workId) || empty($imageName)) {
            abort(404, 'something is wrong');
        }
        $originalImagePath = \public_path(\sprintf(WorkController::WORK_PATH, $userId, $workId) . '/' . $imageName);
        $thumbnailPath = \public_path(\sprintf(self::THUMB_PATH, $userId, $workId) . '/' . $imageName);

        if (!\file_exists($thumbnailPath)) {
            $image = Image::create($originalImagePath);
            $image->resizeToWidth(450);
            if (!File::isDirectory(\public_path(\sprintf(self::THUMB_PATH, $userId, $workId)))) {
                File::makeDirectory(\public_path(\sprintf(self::THUMB_PATH, $userId, $workId)), 0777, true, true);
            }
            $image->save($thumbnailPath, 50);
            $image->send();
            return true;
        }

        $image = Image::create($thumbnailPath);
        $image->send();
        return true;
    }
}
