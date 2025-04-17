<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(600, 1400),
            'description' => $this->faker->sentence,
            'season' => $this->faker->randomElement(['春', '夏', '秋', '冬']),
        ];
    }
}
