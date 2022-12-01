<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceDetail;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            $service = Service::create([
                'user_id'   => $faker->randomElement([1, 2]),
                'title'     => $faker->unique()->word,
                'slug'      => $faker->unique()->slug,
                'tags'      => $faker->words($nb = 4, $asText = false),
                'body'      => $faker->text(500),
                'image'     => $faker->randomElement(['madjou.png', 'madjou2.png']),
            ]);
        }
        for ($i = 0; $i < 50; $i++) {
            ServiceDetail::create([
                'service_id'        => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
                'title'             => $faker->unique()->word,
                'body'              => $faker->text(500),
                'image'             => $faker->randomElement(['madjou.png', 'madjou2.png']),
            ]);
        }
    }
}
