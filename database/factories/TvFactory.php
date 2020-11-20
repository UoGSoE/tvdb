<?php

namespace Database\Factories;

use App\Models\Tv;
use Illuminate\Database\Eloquent\Factories\Factory;

class TvFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tv::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'computer_name' => implode('-', $this->faker->words(3)),
            'computer_id' => $this->faker->numberBetween(1000000, 9999999),
            'last_seen' => now()->subHours(rand(1, 100)),
        ];
    }
}
