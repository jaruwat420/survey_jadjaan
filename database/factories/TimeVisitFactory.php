<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeVisit>
 */
class TimeVisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'time' => $this->faker->word(),
            'flag_status' => $this->faker->randomElement(['A', 'I', 'D']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
