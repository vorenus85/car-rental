<?php

namespace Database\Factories\Fleet;

use App\Models\Fleet\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Brand>
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->company(),
            'image' => fake()->randomElement([
                'audi.jpg',
                'bmw.jpg',
                'mercedes.jpg',
            ])
        ];
    }
}
