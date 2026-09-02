<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Fleet\Car;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class CarAvailabilityController extends Controller
{
    public function availability(
        Car $car
    ): JsonResponse {
        $pickupAt = now()->startOfDay();
        $dropoffAt = now()->addMonths(6)->endOfDay();

        $bookings = $car->bookings()
            ->where('pickup_at', '<', $dropoffAt)
            ->where('dropoff_at', '>', $pickupAt)
            ->get([
                'pickup_at',
                'dropoff_at',
            ]);

        $days = $bookings
            ->flatMap(function ($booking) {
                $currentDay = Carbon::parse($booking->pickup_at)->startOfDay();
                $lastDay = Carbon::parse($booking->dropoff_at)->startOfDay();
                $bookingDays = [];

                while ($currentDay->lte($lastDay)) {
                    $bookingDays[] = $currentDay->toDateString();
                    $currentDay->addDay();
                }

                return $bookingDays;
            })
            ->unique()
            ->values();

        return response()->json([
            'days' => $days,
        ]);
    }
}
