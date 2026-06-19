<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Resources\Storefront\CarListResource;
use App\Http\Resources\Storefront\CarUnitResource;
use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query()
            ->with(['variant', 'variant.model', 'variant.model.brand', 'location'])
            ->where('status', 'available');

        // location
        if ($request->filled('location')) {
            $location = Location::find($request->input('location'));

            if ($location) {
                $query->whereHas('location', function ($q) use ($location) {
                    $q->where('city_id', $location->city_id);
                });
            }
        }

        // body_type
        if ($request->filled('body_type')) {
            $query->whereHas('variant', function ($query) use ($request) {
                $query->whereIn('body_type', (array) $request->body_type);
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
            $request->filled('price_per_day') &&
            is_array($request->price_per_day) &&
            count($request->price_per_day) === 2
        ) {
            $query->whereBetween(
                'price_per_day',
                [
                    $request->price_per_day[0],
                    $request->price_per_day[1],
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
        if ($request->filled('luggage_count')) {
            $query->whereHas('variant', function ($query) use ($request) {
                $query->whereIn('luggage_count', (array) $request->luggage_count);
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

    public function show(Car $car)
    {

        $response = Car::with([
            'variant:id,name,model_id,category,transmission,fuel,seats,doors,range_km,luggage_count,body_type,description',
            'variant.model:id,name,brand_id',
            'variant.model.brand:id,name',
            'features',
        ])->findOrFail($car->id);

        return new CarUnitResource($response);
    }

    public function randomCars()
    {
        $cars = Car::query()
            ->with([
                'variant:id,name,model_id,category,transmission,fuel,seats,luggage_count',
                'variant.model:id,name,brand_id',
                'variant.model.brand:id,name'
            ])
            ->where('status', 'available')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        return CarListResource::collection($cars);
    }
}
