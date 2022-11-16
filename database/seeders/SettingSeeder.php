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
        $contact = Setting::create([
            "code"  => 'contact',
            "name"  => 'contact',
            "slug"  => Str::slug(request()->name),
            ""      => '',
            "image" => '',
            "lang"  => 'id',
        ]);

        $header = Setting::create([
            "code"  => 'header',
            "name"  => 'header',
            "slug"  => Str::slug(request()->name),
            "body"  => '',
            "image" => '',
            "lang"  => 'id',
        ]);
    }
}
