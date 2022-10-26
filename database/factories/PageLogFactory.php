<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageLog>
 */
class PageLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "page" => fake()->randomElement(['blog', 'profile', 'team']),
            "url" => fake()->randomElement(['api/blog', 'api/profile', 'api/team']),
            "ip" => fake()->ipv4(),
            "country" => 'indonesia',
            "province" => fake()->randomElement(['Jawa Timur', 'Jawa Barat', 'Jawa Tengah', 'DKI Jakarta']),
            "city" => fake()->city(),
            "district" => null,
            "agent" => fake()->userAgent(),
            "os" => null,
            "created_at" => fake()->dateTimeThisMonth()
        ];
    }
}
