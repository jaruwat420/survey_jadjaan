<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article13>
 */
class Article13Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_eng' => $this->faker->sentence(3),
            'name_japan' => $this->faker->sentence(3),
            'flag_status' => $this->faker->randomElement(['active', 'inactive']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
