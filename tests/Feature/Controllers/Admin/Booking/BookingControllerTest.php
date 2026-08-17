<?php

use App\Models\Booking\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

describe('BookingController', function () {
    it('returns bookings list', function () {
        Booking::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/bookings');

        $response
            ->assertOk()
            ->assertJsonCount(3)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'bookingNumber',
                    'publicId',
                    'status',
                    'paymentStatus',
                    'pickupAt',
                    'dropoffAt',
                    'customer',
                    'driver',
                    'car',
                    'pickupLocation',
                    'dropoffLocation',
                    'insuranceName',
                    'insurancePrice',
                    'insuranceTotal',
                    'totalAmount',
                    'createdAt',
                    'updatedAt',
                ],
            ]);
    });
});
