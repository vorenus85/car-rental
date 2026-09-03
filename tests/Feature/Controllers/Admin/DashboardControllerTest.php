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

describe('DashboardController', function () {
    it('returns the number of pending bookings', function () {
        Booking::factory()->create([
            'status' => BookingStatus::Pending->value,
        ]);

        Booking::factory()->create([
            'status' => BookingStatus::Pending->value,
        ]);

        Booking::factory()->create([
            'status' => BookingStatus::Confirmed->value,
        ]);

        Booking::factory()->create([
            'status' => BookingStatus::Cancelled->value,
        ]);

        $response = $this->getJson('/api/admin/dashboard/pending-bookings');

        $response->assertOk();

        expect($response->json())->toBe(2);
    });

    it('returns the number of active rentals', function () {
        Booking::factory()->create([
            'status' => BookingStatus::PickedUp->value,
        ]);

        Booking::factory()->create([
            'status' => BookingStatus::PickedUp->value,
        ]);

        Booking::factory()->create([
            'status' => BookingStatus::Confirmed->value,
        ]);

        Booking::factory()->create([
            'status' => BookingStatus::Returned->value,
        ]);

        $response = $this->getJson('/api/admin/dashboard/active-rentals');

        $response->assertOk();

        expect($response->json())->toBe(2);
    });

    it('returns current month revenue for active rental bookings by pickup date', function () {
        Booking::factory()->create([
            'pickup_at' => '2026-09-01 10:00:00',
            'status' => BookingStatus::Confirmed->value,
            'total_amount' => 100.25,
        ]);

        Booking::factory()->create([
            'pickup_at' => '2026-09-15 10:00:00',
            'status' => BookingStatus::PickedUp->value,
            'total_amount' => 200,
        ]);

        Booking::factory()->create([
            'pickup_at' => '2026-09-30 10:00:00',
            'status' => BookingStatus::Returned->value,
            'total_amount' => 300.25,
        ]);

        Booking::factory()->create([
            'pickup_at' => '2026-09-15 10:00:00',
            'status' => BookingStatus::Pending->value,
            'total_amount' => 500,
        ]);

        Booking::factory()->create([
            'pickup_at' => '2026-08-31 10:00:00',
            'status' => BookingStatus::Confirmed->value,
            'total_amount' => 600,
        ]);

        Booking::factory()->create([
            'pickup_at' => '2026-10-01 10:00:00',
            'status' => BookingStatus::Confirmed->value,
            'total_amount' => 700,
        ]);

        $response = $this->getJson('/api/admin/dashboard/monthly-revenue');

        $response->assertOk();

        expect($response->json())->toBe(600.5);
    });
});
