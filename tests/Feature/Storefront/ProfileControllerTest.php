<?php

use App\Models\Booking\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('updates the authenticated customer basic details', function () {
    $customer = Customer::factory()->create([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'phone' => '+36 30 123 4567',
        'email' => 'john@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->actingAs($customer, 'customer')
        ->patchJson('/api/storefront/profile/basic-details', [
            'firstName' => 'Jane',
            'lastName' => 'Smith',
            'phone' => '+36 20 987 6543',
            'email' => 'jane@example.com',
        ]);

    $response->assertOk()
        ->assertJsonPath('message', 'Basic details updated successfully.')
        ->assertJsonPath('customer.firstName', 'Jane')
        ->assertJsonPath('customer.lastName', 'Smith')
        ->assertJsonPath('customer.phone', '+36 20 987 6543')
        ->assertJsonPath('customer.email', 'jane@example.com');

    $this->assertDatabaseHas('customers', [
        'id' => $customer->id,
        'first_name' => 'Jane',
        'last_name' => 'Smith',
        'phone' => '+36 20 987 6543',
        'email' => 'jane@example.com',
    ]);
});

it('rejects duplicate customer email addresses', function () {
    $customer = Customer::factory()->create([
        'email' => 'john@example.com',
    ]);

    Customer::factory()->create([
        'email' => 'jane@example.com',
    ]);

    $response = $this->actingAs($customer, 'customer')
        ->patchJson('/api/storefront/profile/basic-details', [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'phone' => '+36 30 123 4567',
            'email' => 'jane@example.com',
        ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['email']);
});
