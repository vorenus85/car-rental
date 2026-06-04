<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Location',

            'country' => fake()->country(),
            'city' => fake()->city(),
            'address' => fake()->streetAddress(),

            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),

            'type' => fake()->randomElement([
                'airport',
                'railway_station',
                'city_center',
                'office',
                'hotel',
                'other',
            ]),

            'phone' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),

            'business_hours' => [
                'monday' => [
                    'open' => '08:00',
                    'close' => '18:00',
                ],
                'tuesday' => [
                    'open' => '08:00',
                    'close' => '18:00',
                ],
                'wednesday' => [
                    'open' => '08:00',
                    'close' => '18:00',
                ],
                'thursday' => [
                    'open' => '08:00',
                    'close' => '18:00',
                ],
                'friday' => [
                    'open' => '08:00',
                    'close' => '18:00',
                ],
                'saturday' => [
                    'open' => '10:00',
                    'close' => '14:00',
                ],
                'sunday' => null,
            ],

            'image' => fake()->imageUrl(800, 600, 'business'),

            'description' => fake()->paragraph(),

            'is_active' => fake()->boolean(90),
        ];
    }
}
