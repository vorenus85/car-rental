<?php

namespace Database\Seeders\Booking;

use App\Models\Booking\Customer;
use App\Models\Booking\CustomerBillingInfo;
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
        Customer::factory()->has(CustomerBillingInfo::factory(), 'billingInfo')->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => env('USER_EMAIL'),
            'phone' => '123-456-7890',
            'password' => Hash::make(env('USER_PWD')),
            'active' => true,
        ]);

        Customer::factory()
            ->count(100)
            ->has(CustomerBillingInfo::factory(), 'billingInfo')
            ->create([
                'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
                'updated_at' => fn (array $attributes) => $attributes['created_at'],
            ]);

        $this->command->info('Customers data seeded with Customer Billing Information successfully!');
    }
}
