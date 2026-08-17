<?php

use App\Models\Booking\Booking;
use App\Models\Booking\CarDriver;
use App\Models\Booking\Customer;
use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Booking model', function () {
    it('can be created with factory defaults', function () {
        $booking = Booking::factory()->create();

        expect($booking)->toBeInstanceOf(Booking::class);
        expect($booking->customer)->toBeInstanceOf(Customer::class);
        expect($booking->car)->toBeInstanceOf(Car::class);
        expect($booking->pickupLocation)->toBeInstanceOf(Location::class);
        expect($booking->dropoffLocation)->toBeInstanceOf(Location::class);
        expect($booking->driver_id)->not->toBeNull();
    });

    it('has an extras relationship', function () {
        $booking = new Booking;

        expect($booking->extras())
            ->toBeInstanceOf(HasMany::class);
    });

    it('creates a driver alongside the booking', function () {
        $booking = Booking::factory()->create();

        expect(CarDriver::find($booking->driver_id))
            ->toBeInstanceOf(CarDriver::class);
    });
});
