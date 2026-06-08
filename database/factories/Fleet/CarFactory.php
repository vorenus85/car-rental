<?php

namespace Database\Factories\Fleet;

use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use App\Models\Fleet\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'variant_id' => Variant::factory(),

            'location_id' => Location::factory(),

            'licence_plate' => strtoupper(fake()->bothify('???-####')),

            'image' => fake()->imageUrl(),

            'price_per_day' => fake()->numberBetween(20, 200),

            'status' => fake()->randomElement([
                'available',
                'reserved',
                'rented',
                'maintenance',
                'inactive'
            ]),

            'production_year' => fake()->numberBetween(2015, now()->year),

            'mileage' => fake()->numberBetween(5_000, 250_000),

            'color' => fake()->randomElement([
                'white',
                'black',
                'silver',
                'gray',
                'red',
                'blue',
                'green',
                'yellow',
                'orange',
                'brown',
            ]),

            'description' => fake()->optional()->paragraph(),
        ];
    }
}
