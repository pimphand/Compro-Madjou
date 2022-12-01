<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramingLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ["JavaScript", "Python", "Java", "C/CPP", "PHP", "Swift", "C#", "Ruby", "Objective – C ", "SQL"];
        foreach ($data as $key => $value) {
            DB::table('programing_languages')->insert([
                "name" => $value,
                "image" => $value,
            ]);
        }
    }
}
