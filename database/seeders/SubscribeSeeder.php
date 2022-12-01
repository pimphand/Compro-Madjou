<?php

namespace Database\Seeders;

use App\Models\Subscribe;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscribeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            Subscribe::create([
                "email" => $faker->unique()->email,
                "status" =>  $faker->randomElement([1, 0]),
                "location" => "Indonesia"
            ]);
        }
    }
}
