<?php

namespace Database\Factories\Booking;

use App\Models\Booking\Extra;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Extra>
 */
class ExtraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->optional()->paragraph(),
            'price' => fake()->numberBetween(1, 50),
            'icon' => fake()->optional()->word(),
            'maxQuantity' => fake()->numberBetween(1, 5),
        ];
    }
}
