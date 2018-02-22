<?php

namespace RecycleArt\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ImageResize\Image;
use RecycleArt\Models\WorkImages;

/**
 * Class MakeThumbs
 * @package RecycleArt\Console\Commands
 */
class MakeThumbs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:thumbs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make thumbs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $images = (new WorkImages())->getList();
        if (empty($images)) {
            return 'nothing todo';
        }
        foreach ($images as $image) {
            list(, $userId, , $workId, $imageName) = explode('/', $image['link']);
            $thumbPath = \str_replace('engine/public/', '', \public_path(\sprintf(WorkImages::THUMB_PATH, $userId, $workId)));
            $origPath = \str_replace('engine/public/', '', \public_path(\sprintf(WorkImages::LINK_PATH, $userId, $workId, $imageName)));
            print  $thumbPath . PHP_EOL;
            if (!\file_exists($thumbPath . '/' . $imageName)) {
                if (!File::isDirectory($thumbPath)) {
                    File::makeDirectory($thumbPath . '/thumb', 0777, true, true);
                }
                $this->makeThumb($origPath, $thumbPath . '/thumb/' . $imageName);
            }
        }
        return 'OK!' . PHP_EOL;
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
            ->save($thumbFilePath, 50);
    }
}
