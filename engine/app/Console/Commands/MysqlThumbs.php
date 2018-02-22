<?php

namespace RecycleArt\Console\Commands;

use Illuminate\Console\Command;
use RecycleArt\Models\WorkImages;
use SebastianBergmann\CodeCoverage\Report\PHP;

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
            if (empty($image['link'])) {
                print 'db is empty' . PHP_EOL;
//                print 'OK' . PHP_EOL;
//                $image = WorkImages::find($image['id']);
//                $image->thumb = $thumbPath . '/' . $linkData[4];
//                $image->save();
            }
            if (\file_exists($thumbPath . '/' . $linkData[4])) {
                print 'file_exists' . PHP_EOL;
            }
        }
        return 'OK!' . PHP_EOL;
    }
}
