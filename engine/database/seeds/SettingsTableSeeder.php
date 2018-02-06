<?php

use RecycleArt\Models\Role;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
//        $setting = new \RecycleArt\Models\Settings();
//        $setting->setting_slug = 'slogan';
//        $setting->setting_name = 'Слоган';
//        $setting->setting_value = 'some content here...';
//        $setting->save();
//        $setting = null;
//
//        $setting = new \RecycleArt\Models\Settings();
//        $setting->setting_slug = 'limitWorksForGallery';
//        $setting->setting_name = 'Количество работ на странице галлереи';
//        $setting->setting_value = '30';
//        $setting->save();

        $setting = new \RecycleArt\Models\Settings();
        $setting->setting_slug = 'generalPageBlock';
        $setting->setting_name = '(на главной странице, перед новостями) разместить еще один текстовой блок';
        $setting->setting_value = 'some content for users here...';
        $setting->save();

  }
}
