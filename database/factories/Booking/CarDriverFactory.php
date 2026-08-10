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
            'firstName' => $firstName,
            'lastName' => $lastName,
            'phone' => fake()->phoneNumber(),
            'birthDate' => fake()->dateTimeBetween('-70 years', '-21 years'),
            'licenceNumber' => strtoupper(fake()->bothify('??######')),
            'licenceCountry' => fake()->randomElement(['HU', 'AT', 'CZ']),
            'licenceIssueDate' => fake()->dateTimeBetween('-20 years', '-1 year'),
            'licenceExpiryDate' => fake()->dateTimeBetween('+1 year', '+10 years'),
        ];
    }
}
