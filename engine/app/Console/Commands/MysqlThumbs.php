<?php

namespace RecycleArt\Console\Commands;

use Illuminate\Console\Command;
use RecycleArt\Models\WorkImages;

class MysqlThumbs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:thumbs_db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     */
    public function handle()
    {
        $images = (new WorkImages())->getList();
        if (empty($images)) {
            return 'nothing todo';
        }
        foreach ($images as $image) {
            $linkData = explode('/', $image['link']);
            if (!\is_numeric($linkData[1]) || !\is_numeric($linkData[3])) {
                continue;
            }
            $thumbPath = \str_replace('engine/public/', '', \public_path(\sprintf(WorkImages::THUMB_PATH, $linkData[1], $linkData[3])));
            print $thumbPath . '/' . $linkData[4] . PHP_EOL;
            if (!empty($image['thumb']) && \file_exists($thumbPath . '/' . $linkData[4])) {
                $image = WorkImages::find($image['id']);
                $image->thumb = \sprintf(WorkImages::LINK_PATH, $linkData[1], $linkData[3], $linkData[4]);
                $image->save();
                print 'Updated' . PHP_EOL;
            }
        }
        return 'OK!' . PHP_EOL;
    }
}
