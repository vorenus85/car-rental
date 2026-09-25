<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\BookingResource;
use App\Models\Booking\Booking;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = $this->bookingListQuery();

        if ($request->filled('dropOffDate')) {
            $query->whereDate('dropoff_at', $request->query('dropOffDate'));
        }

        if ($request->filled('pickUpDate')) {
            $query->whereDate('pickup_at', $request->query('pickUpDate'));
        }


        $bookings = $query->get();

        return response()->json(BookingResource::collection($bookings), 200);
    }

    public function activeRentals(): JsonResponse
    {
        $bookings = $this->bookingListQuery()
            ->activeRental()
            ->get();

        return response()->json(BookingResource::collection($bookings), 200);
    }

    public function upcomingRentals(): JsonResponse
    {
        $bookings = $this->bookingListQuery()
            ->upcomingRental()
            ->get();

        return response()->json(BookingResource::collection($bookings), 200);
    }

    public function pendingRentals(): JsonResponse
    {
        $bookings = $this->bookingListQuery()
            ->pendingRental()
            ->get();

        return response()->json(BookingResource::collection($bookings), 200);
    }

    public function overdueRentals(): JsonResponse
    {
        $bookings = $this->bookingListQuery()
            ->overdueRental()
            ->get();

        return response()->json(BookingResource::collection($bookings), 200);
    }

    /**
     * @return Builder<Booking>
     */
    private function bookingListQuery(): Builder
    {
        return Booking::query()
            ->with([
                'customer:id,first_name,last_name,email',
                'driver:id,first_name,last_name,phone',
                'car.variant.model.brand',
                'pickupLocation.cityModel',
                'dropoffLocation.cityModel',
                'insurance:id,name,price',
                'extras',
            ])
            ->orderByDesc('pickup_at')
            ->orderByDesc('created_at');
    }
}
