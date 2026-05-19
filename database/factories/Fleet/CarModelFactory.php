<?php

namespace Database\Factories\Fleet;

use App\Models\Fleet\Brand;
use App\Models\Fleet\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CarModel>
 */
class CarModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<CarModel>
     */
    protected $model = CarModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'brand_id' => Brand::factory(),
        ];
    }
}
