<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // demo admin user
        Customer::factory()->create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => env('USER_EMAIL'),
            'phone' => '123-456-7890',
            'password' => Hash::make(env('USER_PWD')),
            'active' => true,
        ]);

        Customer::factory()
            ->count(100)
            ->create([
                'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
                'updated_at' => fn(array $attributes) => $attributes['created_at'],
            ]);

        $this->command->info('Customers data seeded successfully!');
    }
}
