<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Article22Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_eng' => $this->faker->word(),
            'name_japan' => $this->faker->word() . 'の' . $this->faker->word(),
            'flag_status' => $this->faker->randomElement(['A', 'I', 'D']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
