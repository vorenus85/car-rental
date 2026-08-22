<?php

use App\Models\Booking\Booking;
use App\Models\Booking\Customer;
use App\Models\Booking\Insurance;
use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use App\Notifications\Storefront\BookingInvoiceNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

describe('BookingController', function () {
    it('sends booking invoice email after creating a booking', function () {
        Notification::fake();

        $customer = Customer::factory()->create();
        $pickupLocation = Location::factory()->create();
        $dropoffLocation = Location::factory()->create();
        $car = Car::factory()->create();
        $insurance = Insurance::create([
            'name' => 'Premium Coverage',
            'description' => 'Test insurance coverage',
            'price' => 6,
            'recommended' => true,
        ]);

        $payload = [
            'customerId' => $customer->id,
            'carId' => $car->id,
            'pickUpLocationId' => $pickupLocation->id,
            'dropOffLocationId' => $dropoffLocation->id,
            'pickUpDate' => now()->addDay()->format('Y-m-d'),
            'dropOffDate' => now()->addDays(4)->format('Y-m-d'),
            'pickUpTime' => '10:00',
            'dropOffTime' => '14:30',
            'driver_first_name' => 'Jane',
            'driver_last_name' => 'Driver',
            'driver_phone' => '+36 30 123 4567',
            'driver_birth_date' => '1990-01-01',
            'driver_licence_number' => 'AB123456',
            'driver_licence_country' => 'HU',
            'driver_licence_issue_date' => '2015-01-01',
            'driver_licence_expiry_date' => '2030-01-01',
            'payment_method' => 'stripe',
            'notes' => 'Test booking',
            'insurance_id' => $insurance->id,
            'extras' => [],
        ];

        $response = $this->actingAs($customer, 'customer')
            ->withSession(['_token' => 'test-token'])
            ->postJson('/api/storefront/booking', [
                ...$payload,
                '_token' => 'test-token',
            ]);

        $response
            ->assertCreated()
            ->assertJsonPath('booking.customer_id', $customer->id);

        Notification::assertSentTo($customer, BookingInvoiceNotification::class);
    });

    it('downloads booking invoice as pdf', function () {
        $customer = Customer::factory()->create();
        $pickupLocation = Location::factory()->create();
        $dropoffLocation = Location::factory()->create();
        $car = Car::factory()->create(['image' => null]);
        $booking = Booking::factory()->create([
            'customer_id' => $customer->id,
            'car_id' => $car->id,
            'pickup_location_id' => $pickupLocation->id,
            'dropoff_location_id' => $dropoffLocation->id,
        ]);

        $response = $this->actingAs($customer, 'customer')
            ->get('/api/storefront/booking/invoice?publicId='.$booking->public_id);

        $response->assertOk();
        $response->assertDownload($booking->booking_number.'-invoice.pdf');
    });
});
