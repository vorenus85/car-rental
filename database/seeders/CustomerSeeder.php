<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Customer::factory()
            ->count(100)
            ->create([
                'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
                'updated_at' => fn(array $attributes) => $attributes['created_at'],
            ]);

        $this->command->info('Customers data seeded successfully!');
    }
}
