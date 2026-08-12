<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storefront\BookingStoreRequest;
use App\Http\Resources\Storefront\BookingOrderResource;
use App\Http\Resources\Storefront\CarBookingResource;
use App\Models\Booking\Booking;
use App\Models\Booking\BookingExtra;
use App\Models\Booking\CarDriver;
use App\Models\Booking\Extra;
use App\Models\Booking\Insurance;
use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function bookingData(Request $request): JsonResponse
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

    public function order(Request $request): BookingOrderResource
    {
        $validated = $request->validate([
            'publicId' => ['required', 'string', 'exists:bookings,public_id'],
        ]);

        $booking = Booking::with([
            'customer:id,email',
            'car.variant.model.brand',
            'pickupLocation.cityModel',
            'dropoffLocation.cityModel',
            'extras',
        ])->where('public_id', $validated['publicId'])->firstOrFail();

        return new BookingOrderResource($booking);
    }

    public function store(BookingStoreRequest $request): JsonResponse
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

        /**
         * @var array{
         *   customerId: int,
         *   carId: int,
         *   pickUpLocationId: int,
         *   dropOffLocationId: int,
         *   driver_first_name: string,
         *   driver_last_name: string,
         *   driver_email: string,
         *   driver_phone: string,
         *   driver_birth_date: string,
         *   driver_licence_number: string,
         *   driver_licence_country: string,
         *   driver_licence_issue_date: string,
         *   driver_licence_expiry_date: string,
         *   payment_method: string,
         *   extras?: array<int, array{id: int, quantity: int}>
         * } $validated
         */
        /** @var Collection<int, array{id:int, quantity:int}> $selectedExtras */
        $selectedExtras = collect($validated['extras'] ?? []);

        /** @var Collection<int, Extra> $extraModels */
        $extraModels = $selectedExtras->isEmpty()
            ? collect()
            : Extra::query()
            ->whereIn('id', $selectedExtras->pluck('id')->all())
            ->get()
            ->keyBy('id');

        $days = (int) $pickupAt->diffInDays($dropoffAt);
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
            $random = Str::upper(Str::random(16));

            $carDriver = CarDriver::create([
                'first_name' => $validated['driver_first_name'],
                'last_name' => $validated['driver_last_name'],
                'phone' => $validated['driver_phone'],
                'birth_date' => $validated['driver_birth_date'],
                'licence_number' => $validated['driver_licence_number'],
                'licence_country' => $validated['driver_licence_country'],
                'licence_issue_date' => $validated['driver_licence_issue_date'],
                'licence_expiry_date' => $validated['driver_licence_expiry_date'],
            ]);

            $booking = Booking::create([
                'booking_number' => 'TMP-' . now()->format('YmdHisv'),
                'public_id' => 'BKG-' . implode('-', str_split($random, 4)),
                'customer_id' => $validated['customerId'],
                'car_id' => $validated['carId'],

                'pickup_location_id' => $validated['pickUpLocationId'],
                'dropoff_location_id' => $validated['dropOffLocationId'],

                'pickup_at' => $pickupAt,
                'dropoff_at' => $dropoffAt,
                'days' => $days,

                'payment_method' => $validated['payment_method'],

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
                'driver_id' => $carDriver->id,
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
                'customer:id,first_name,last_name,email',
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
