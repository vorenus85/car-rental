<?php

namespace Database\Factories\Fleet;

use App\Models\Fleet\CarModel;
use App\Models\Fleet\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Variant>
 */
class VariantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Variant>
     */
    protected $model = Variant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),

            'model_id' => CarModel::factory(),

            'category' => fake()->randomElement([
                'economy',
                'compact',
                'suv',
                'business',
                'premium'
            ]),

            'description' => fake()->sentence(),

            'body_type' => fake()->randomElement([
                'suv',
                'sedan',
                'hatchback',
                'coupe',
                'wagon'
            ]),

            'transmission' => fake()->randomElement([
                'manual',
                'automatic',
            ]),

            'fuel' => fake()->randomElement([
                'petrol',
                'diesel',
                'hybrid',
                'electric',
            ]),

            'seats' => fake()->numberBetween(2, 7),

            'doors' => fake()->randomElement([
                2,
                3,
                4,
                5,
            ]),

            'luggage_count' => fake()->randomElement([
                1,
                2,
                3,
                4,
                5,
            ]),

            'range_km' => fake()->numberBetween(450, 900),
        ];
    }
}
