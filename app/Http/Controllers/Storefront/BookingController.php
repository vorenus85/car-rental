<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storefront\BookingStoreRequest;
use App\Http\Resources\Storefront\CarBookingResource;
use App\Models\Booking;
use App\Models\BookingExtra;
use App\Models\Extra;
use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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

    public function store(BookingStoreRequest $request)
    {
        $validated = $request->validated();

        $pickupAt = Carbon::createFromFormat(
            'Y-m-d H:i',
            "{$validated['pickUpDate']} {$validated['pickUpTime']}"
        );

        $dropoffAt = Carbon::createFromFormat(
            'Y-m-d H:i',
            "{$validated['dropOffDate']} {$validated['dropOffTime']}"
        );

        if ($dropoffAt->lessThanOrEqualTo($pickupAt)) {
            throw ValidationException::withMessages([
                'dropOffDate' => 'Drop-off must be after pick-up.',
            ]);
        }

        $car = Car::query()->findOrFail($validated['carId']);

        $insurance = Insurance::query()->findOrFail($validated['insurance_id']);

        $selectedExtras = collect($validated['extras'] ?? []);

        $extraModels = $selectedExtras->isEmpty()
            ? collect()
            : Extra::query()
                ->whereIn('id', $selectedExtras->pluck('id')->all())
                ->get()
                ->keyBy('id');

        $days = $pickupAt->diffInDays($dropoffAt);
        $dailyRate = (float) $car->price_per_day;
        $subtotal = $days * $dailyRate;
        $insuranceTotal = $days * (float) $insurance->price;
        $extrasTotal = $selectedExtras->reduce(function (float $carry, array $extra) use ($days, $extraModels) {
            $extraModel = $extraModels->get($extra['id']);

            if (! $extraModel) {
                return $carry;
            }

            return $carry + ((int) $extra['quantity'] * $days * (float) $extraModel->price);
        }, 0.0);

        $totalAmount = $subtotal + $insuranceTotal + $extrasTotal;

        $booking = DB::transaction(function () use (
            $validated,
            $pickupAt,
            $dropoffAt,
            $days,
            $dailyRate,
            $subtotal,
            $insuranceTotal,
            $extrasTotal,
            $totalAmount,
            $insurance,
            $selectedExtras,
            $extraModels
        ) {
            $booking = Booking::create([
                'booking_number' => 'TMP-'.now()->format('YmdHisv'),

                'customer_id' => $validated['customerId'],
                'car_id' => $validated['carId'],

                'pickup_location_id' => $validated['pickUpLocationId'],
                'dropoff_location_id' => $validated['dropOffLocationId'],

                'pickup_at' => $pickupAt,
                'dropoff_at' => $dropoffAt,
                'days' => $days,

                'driver_first_name' => $validated['driver_first_name'],
                'driver_last_name' => $validated['driver_last_name'],
                'driver_email' => $validated['driver_email'],
                'driver_phone' => $validated['driver_phone'],
                'driver_birth_date' => $validated['driver_birth_date'],

                'driver_country' => $validated['driver_country'],
                'driver_city' => $validated['driver_city'],
                'driver_postal_code' => $validated['driver_postal_code'],
                'driver_address_line_1' => $validated['driver_address_line_1'],
                'driver_address_line_2' => $validated['driver_address_line_2'] ?? null,

                'driver_licence_number' => $validated['driver_licence_number'],
                'driver_licence_country' => $validated['driver_licence_country'],
                'driver_licence_issue_date' => $validated['driver_licence_issue_date'],
                'driver_licence_expiry_date' => $validated['driver_licence_expiry_date'],

                'currency' => 'EUR',
                'daily_rate' => $dailyRate,
                'subtotal' => $subtotal,
                'extras_total' => $extrasTotal,
                'insurance_id' => $insurance->id,
                'insurance_name' => $insurance->name,
                'insurance_price' => $insurance->price,
                'insurance_total' => $insuranceTotal,
                'tax_total' => 0,
                'total_amount' => $totalAmount,
            ]);

            $booking->update([
                'booking_number' => $this->generateBookingNumber($booking),
            ]);

            DB::table('booking_insurance')->insert([
                'booking_id' => $booking->id,
                'insurance_id' => $insurance->id,
                'name' => $insurance->name,
                'price' => $insurance->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($selectedExtras as $selectedExtra) {
                $extraModel = $extraModels->get($selectedExtra['id']);

                if (! $extraModel) {
                    continue;
                }

                BookingExtra::create([
                    'booking_id' => $booking->id,
                    'extra_id' => $extraModel->id,
                    'name' => $extraModel->name,
                    'quantity' => (int) $selectedExtra['quantity'],
                    'unit_price' => $extraModel->price,
                    'total_price' => (int) $selectedExtra['quantity'] * $days * (float) $extraModel->price,
                ]);
            }

            return $booking;
        });

        return response()->json([
            'booking' => $booking->load([
                'customer:id,name,email',
                'car.variant.model.brand',
                'pickupLocation.cityModel',
                'dropoffLocation.cityModel',
                'extras',
            ]),
        ], 201);
    }

    private function generateBookingNumber(Booking $booking): string
    {
        return sprintf('CR-%s-%06d', $booking->created_at->format('Ymd'), $booking->id);
    }
}
