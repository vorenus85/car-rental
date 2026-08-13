<?php

use App\Models\Booking\CustomerBillingInfo;
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

it('changes the authenticated customer password', function () {
    $customer = Customer::factory()->create([
        'password' => Hash::make('password123'),
    ]);

    $response = $this->actingAs($customer, 'customer')
        ->patchJson('/api/storefront/profile/password', [
            'current_password' => 'password123',
            'password' => 'newpassword456',
            'password_confirmation' => 'newpassword456',
        ]);

    $response->assertOk()
        ->assertJsonPath('message', 'Password changed successfully.');

    $this->assertTrue(Hash::check('newpassword456', $customer->fresh()->password));
});

it('updates the authenticated customer billing info', function () {
    $customer = Customer::factory()->create([
        'password' => Hash::make('password123'),
    ]);

    $response = $this->actingAs($customer, 'customer')
        ->patchJson('/api/storefront/profile/billing-info', [
            'name' => 'ACME Ltd.',
            'country' => 'HU',
            'postcode' => '1051',
            'city' => 'Budapest',
            'address' => 'Kossuth Lajos utca 1.',
            'company_name' => 'ACME Ltd.',
            'tax_number' => '12345678-1-42',
            'eu_vat_number' => 'HU12345678',
        ]);

    $response->assertOk()
        ->assertJsonPath('message', 'Billing info updated successfully.')
        ->assertJsonPath('billingInfo.name', 'ACME Ltd.')
        ->assertJsonPath('billingInfo.country', 'HU')
        ->assertJsonPath('billingInfo.postcode', '1051')
        ->assertJsonPath('billingInfo.city', 'Budapest')
        ->assertJsonPath('billingInfo.address', 'Kossuth Lajos utca 1.')
        ->assertJsonPath('billingInfo.companyName', 'ACME Ltd.')
        ->assertJsonPath('billingInfo.taxNumber', '12345678-1-42')
        ->assertJsonPath('billingInfo.euVatNumber', 'HU12345678');

    $this->assertDatabaseHas((new CustomerBillingInfo())->getTable(), [
        'customer_id' => $customer->id,
        'name' => 'ACME Ltd.',
        'country' => 'HU',
        'postcode' => '1051',
        'city' => 'Budapest',
        'address' => 'Kossuth Lajos utca 1.',
        'company_name' => 'ACME Ltd.',
        'tax_number' => '12345678-1-42',
        'eu_vat_number' => 'HU12345678',
    ]);
});
