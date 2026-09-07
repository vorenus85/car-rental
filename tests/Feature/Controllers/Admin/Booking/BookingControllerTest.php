<?php

use App\Enums\BookingStatus;
use App\Models\Booking\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

beforeEach(function () {
    Carbon::setTestNow('2026-09-15 12:00:00');

    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

afterEach(function () {
    Carbon::setTestNow();
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

    it('returns only active rentals', function () {
        Carbon::setTestNow('2026-09-15 12:00:00');

        $activeRental = Booking::factory()->create([
            'status' => BookingStatus::PickedUp->value,
            'pickup_at' => '2026-09-15 10:00:00',
            'dropoff_at' => '2026-09-16 10:00:00',
        ]);

        $pickupBoundaryRental = Booking::factory()->create([
            'status' => BookingStatus::PickedUp->value,
            'pickup_at' => '2026-09-15 12:00:00',
            'dropoff_at' => '2026-09-16 10:00:00',
        ]);

        $dropoffBoundaryRental = Booking::factory()->create([
            'status' => BookingStatus::PickedUp->value,
            'pickup_at' => '2026-09-14 10:00:00',
            'dropoff_at' => '2026-09-15 12:00:01',
        ]);

        // Not active because the booking has not been picked up yet.
        Booking::factory()->create([
            'status' => BookingStatus::Confirmed->value,
            'pickup_at' => '2026-09-15 12:00:01',
            'dropoff_at' => '2026-09-16 10:00:00',
        ]);

        // Not active because the rental has already ended.
        Booking::factory()->create([
            'status' => BookingStatus::Confirmed->value,
            'pickup_at' => '2026-09-14 10:00:00',
            'dropoff_at' => '2026-09-15 11:59:59',
        ]);

        // Not active because of their booking status.
        foreach (
            [
                BookingStatus::Pending,
                BookingStatus::Returned,
                BookingStatus::Cancelled,
            ] as $status
        ) {
            Booking::factory()->create([
                'status' => $status->value,
                'pickup_at' => '2026-09-15 10:00:00',
                'dropoff_at' => '2026-09-16 10:00:00',
            ]);
        }

        $response = $this->getJson('/api/admin/bookings/active-rentals');

        $response
            ->assertOk()
            ->assertJsonCount(3)
            ->assertJsonPath('0.id', $pickupBoundaryRental->id)
            ->assertJsonPath('1.id', $activeRental->id)
            ->assertJsonPath('2.id', $dropoffBoundaryRental->id);

        Carbon::setTestNow();
    });
});
