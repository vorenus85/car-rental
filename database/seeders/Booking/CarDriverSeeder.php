<?php

namespace Database\Seeders\Booking;

use App\Models\Booking\CarDriver;
use Illuminate\Database\Seeder;

class CarDriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarDriver::factory()
            ->count(100)
            ->create([
                'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
                'updated_at' => fn (array $attributes) => $attributes['created_at'],
            ]);

        $this->command->info('Car drivers data seeded successfully!');
    }
}
