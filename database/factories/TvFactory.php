<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TvFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'computer_name' => implode('-', $this->faker->words(3)),
            'computer_id' => $this->faker->numberBetween(1000000, 9999999),
            'last_seen' => now()->subHours(rand(1, 100)),
        ];
    }
}
