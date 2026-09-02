<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Resources\Storefront\CarListResource;
use App\Http\Resources\Storefront\CarUnitResource;
use App\Http\Services\Storefront\SimilarCarsService;
use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;

class CarController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Car::query()
            ->with(['variant', 'variant.model', 'variant.model.brand', 'location'])
            ->where('status', 'available');

        $this->filterByAvailability($query, $request);

        // location
        if ($request->filled('pickUpLocation')) {
            $pickUpLocation = Location::find($request->input('pickUpLocation'));

            if ($pickUpLocation) {
                $query->whereHas('location', function ($q) use ($pickUpLocation) {
                    $q->where('city_id', $pickUpLocation->city_id);
                });
            }
        }

        // brand
        if ($request->filled('brand')) {
            $query->whereHas('variant.model.brand', function ($query) use ($request) {
                $query->whereIn('id', (array) $request->brand);
            });
        }

        // body_type
        if ($request->filled('bodyType')) {
            $query->whereHas('variant', function ($query) use ($request) {
                $query->whereIn('body_type', (array) $request->bodyType);
            });
        }

        // fuel_type
        if ($request->filled('fuel')) {
            $query->whereHas('variant', function ($query) use ($request) {
                $query->whereIn('fuel', (array) $request->fuel);
            });
        }

        // price range
        if (
            $request->filled('pricePerDay') &&
            is_array($request->pricePerDay) &&
            count($request->pricePerDay) === 2
        ) {
            $query->whereBetween(
                'price_per_day',
                [
                    $request->pricePerDay[0],
                    $request->pricePerDay[1],
                ]
            );
        }

        // transmission
        if ($request->filled('transmission')) {
            $query->whereHas('variant', function ($query) use ($request) {
                $query->whereIn('transmission', (array) $request->transmission);
            });
        }

        // seats
        if ($request->filled('seats')) {
            $query->whereHas('variant', function ($query) use ($request) {
                $query->whereIn('seats', (array) $request->seats);
            });
        }

        // luggage_count
        if ($request->filled('luggageCount')) {
            $query->whereHas('variant', function ($query) use ($request) {
                $query->whereIn('luggage_count', (array) $request->luggageCount);
            });
        }

        if ($request->filled('sort')) {

            match ($request->sort) {

                'price_asc' => $query->orderBy('price_per_day', 'asc'),

                'price_desc' => $query->orderBy('price_per_day', 'desc'),

                'year_asc' => $query->orderBy('production_year', 'asc'),

                'year_desc' => $query->orderBy('production_year', 'desc'),

                default => $query->latest(),
            };
        } else {
            $query->orderBy('price_per_day', 'desc');
        }

        $cars = $query->paginate(
            $request->integer('per_page', 12)
        );

        return CarListResource::collection($cars);
    }

    private function filterByAvailability(Builder $query, Request $request): void
    {
        if (! $request->filled('pickUpDate') && ! $request->filled('dropOffDate')) {
            return;
        }

        $validated = $request->validate([
            'pickUpDate' => ['required', 'date_format:Y-m-d'],
            'dropOffDate' => ['required', 'date_format:Y-m-d', 'after_or_equal:pickUpDate'],
        ]);

        $pickupAt = Carbon::createFromFormat('!Y-m-d', $validated['pickUpDate'])->startOfDay();
        $dropoffAt = Carbon::createFromFormat('!Y-m-d', $validated['dropOffDate'])->endOfDay();

        $query->whereDoesntHave('bookings', function (Builder $bookingQuery) use ($pickupAt, $dropoffAt) {
            $bookingQuery
                ->where('pickup_at', '<=', $dropoffAt)
                ->where('dropoff_at', '>=', $pickupAt);
        });
    }

    public function show(Car $car): CarUnitResource
    {

        $response = Car::with([
            'variant:id,name,model_id,transmission,fuel,seats,doors,range_km,luggage_count,body_type,description',
            'variant.model:id,name,brand_id',
            'variant.model.brand:id,name',
            'features' => fn ($query) => $query->orderBy('name'),
        ])->findOrFail($car->id);

        return new CarUnitResource($response);
    }

    public function randomCars(): AnonymousResourceCollection
    {
        $cars = Car::query()
            ->with([
                'variant:id,name,model_id,transmission,fuel,seats,luggage_count',
                'variant.model:id,name,brand_id',
                'variant.model.brand:id,name',
            ])
            ->where('status', 'available')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        return CarListResource::collection($cars);
    }

    public function similarCars(
        Car $car,
        SimilarCarsService $similarCarsService
    ): AnonymousResourceCollection {
        $similarCars = $similarCarsService->getSimilarCars($car);

        return CarListResource::collection($similarCars);
    }
}
