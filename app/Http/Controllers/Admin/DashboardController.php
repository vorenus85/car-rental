<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking\Booking;
use App\Models\Fleet\Car;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function availableCarsKpi(): JsonResponse
    {
        $availableCars = Car::where('status', 'available')->count();

        return response()->json($availableCars);
    }

    public function pendingBookingsKpi(): JsonResponse
    {
        $pendingBookings = Booking::query()
            ->where('status', BookingStatus::Pending->value)
            ->count();

        return response()->json($pendingBookings);
    }

    public function activeRentalsKpi(): JsonResponse
    {
        $activeRentals = Booking::query()
            ->where('status', BookingStatus::PickedUp->value)
            ->count();

        return response()->json($activeRentals);
    }

    public function todayDropoffsKpi(): JsonResponse
    {
        $todayDropoffs = Booking::query()
            ->whereDate('dropoff_at', today())
            ->whereIn('status', [
                BookingStatus::Confirmed->value,
                BookingStatus::PickedUp->value,
            ])
            ->count();

        return response()->json($todayDropoffs);
    }

    public function todayPickupKpi(): JsonResponse
    {
        $todayPickups = Booking::query()
            ->whereDate('pickup_at', today())
            ->whereIn('status', [
                BookingStatus::Confirmed->value,
            ])
            ->count();

        return response()->json($todayPickups);
    }

    public function monthlyRevenueKpi(): JsonResponse
    {
        $monthlyRevenue = Booking::query()
            ->whereBetween('pickup_at', [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])
            ->whereIn('status', [
                BookingStatus::Confirmed->value,
                BookingStatus::PickedUp->value,
                BookingStatus::Returned->value,
            ])
            ->sum('total_amount');

        return response()->json((float) $monthlyRevenue);
    }
}
