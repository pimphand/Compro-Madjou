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
        $data = ['script-header', 'script-footer'];

        foreach ($data as $key => $value) {
            Setting::create([
                "code"  => $value,
                "name"  => $value,
                "slug"  => $value,
                "body"  => $value,
                "image" => '',
                "lang"  => 'id',
            ]);
        }
    }
}
