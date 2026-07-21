<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Resources\Storefront\CarBookingResource;
use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookingData(Request $request)
    {
        $request->validate([
            'carId' => ['required', 'integer', 'exists:cars,id'],
            'pickUpLocationId' => ['required', 'integer', 'exists:locations,id'],
            'dropOffLocationId' => ['required', 'integer', 'exists:locations,id'],
        ]);


        $pickup = Location::select(['id', 'name', 'city_id'])
            ->with('cityModel:id,name')
            ->findOrFail($request->pickUpLocationId);

        $dropoff = $request->pickUpLocationId == $request->dropOffLocationId
            ? $pickup
            : Location::select(['id', 'name', 'city_id'])
            ->with('cityModel:id,name')
            ->findOrFail($request->dropOffLocationId);

        $car = Car::with([
            'variant:id,name,model_id',
            'variant.model:id,name,brand_id',
            'variant.model.brand:id,name',
        ])->findOrFail($request->carId);

        return response()->json([
            'car' => new CarBookingResource($car),
            'pickUpLocation' => $pickup,
            'dropOffLocation' => $dropoff,
        ]);
    }
}
