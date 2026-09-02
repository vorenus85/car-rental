<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Fleet\Car;
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

        return response()->json([
            'bookings' => $bookings,
        ]);
    }
}
