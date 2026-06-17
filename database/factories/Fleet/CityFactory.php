<?php

namespace Database\Factories\Fleet;

use App\Models\Fleet\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<City>
 */
class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->city(),
        ];
    }
}
