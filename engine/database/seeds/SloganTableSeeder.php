<?php

use RecycleArt\Models\Role;
use RecycleArt\Models\User;
use Illuminate\Database\Seeder;

class SloganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slogan = new \RecycleArt\Models\Slogan;
        $slogan->content = 'some content...';
        $slogan->save();
    }
}
