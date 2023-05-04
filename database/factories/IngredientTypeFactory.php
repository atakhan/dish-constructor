<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IngredientType>
 */
class IngredientTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'code'  => $this->faker->randomElement(['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i',]),
        ];
    }
}
