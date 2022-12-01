<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 10; $i++) {
            BlogCategory::create([
                "name" => $faker->unique()->word,
                "lang" => $faker->randomElement(['id', 'en']),
            ]);
        }

        for ($i = 0; $i < 50; $i++) {
            Blog::create([
                "blog_category_id" => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
                "title" => $faker->unique()->word,
                "slug" => $faker->slug,
                "body" => $faker->text(500),
                "tags" => $faker->words($nb = 4, $asText = false),
                "author" => $faker->randomElement([1, 2]),
                "image" => $faker->randomElement(['madjou.png', 'madjou2.png']),
                "lang" => $faker->randomElement(['id', 'en']),
            ]);
        }
    }
}
