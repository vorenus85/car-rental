<?php

namespace Database\Factories\Booking;

use App\Models\Booking\CarDriver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CarDriver>
 */
class CarDriverFactory extends Factory
{
    protected $model = CarDriver::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone' => fake()->phoneNumber(),
            'birth_date' => fake()->dateTimeBetween('-70 years', '-21 years'),
            'licence_number' => strtoupper(fake()->bothify('??######')),
            'licence_country' => fake()->randomElement(['HU', 'AT', 'CZ']),
            'licence_issue_date' => fake()->dateTimeBetween('-20 years', '-1 year'),
            'licence_expiry_date' => fake()->dateTimeBetween('+1 year', '+10 years'),
        ];
    }
}
