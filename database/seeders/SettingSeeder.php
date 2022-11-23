<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            "code"  => 'contact',
            "name"  => 'contact',
            "slug"  => 'contact',
            "body"      => '',
            "image" => '',
            "lang"  => 'id', 
        ]);

        Setting::create([
            "code"  => 'header',
            "name"  => 'header',
            "slug"  => 'header',
            "body"  => '',
            "image" => '',
            "lang"  => 'id',
        ]);

       
    }
}
