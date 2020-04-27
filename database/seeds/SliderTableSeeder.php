<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            'title_ru' => 'title ru',
            'title_ua' => 'title ua',
            'description_ua' => 'text ru',
            'description_ru' => 'text ua',
            'sort'      => 0,
            'active'    => 1,
            'type'      => 1,
        ]);

        DB::table('slider_images')->insert([
            'slider_id' => 1,
            'file_name' => 'test.jpg',
            't_file_name' => 'test_tablet.jpg',
            'm_file_name' => 'test_mobile.jpg',
        ]);
    }
}
