<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Resources\Storefront\CarCardResource;
use App\Models\Fleet\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query()->with(['variant', 'variant.model', 'variant.model.brand'])->where('status', 'available');

        // location_id
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }
        // category
        if ($request->filled('category')) {
            $query->whereHas('variant', function ($query) use ($request) {
                $query->where('category', $request->category);
            });
        }
        // fuel_type
        if ($request->filled('fuel_type')) {
            $query->whereHas('variant', function ($query) use ($request) {
                $query->where('fuel_type', $request->fuel_type);
            });
        }
        // transmission
        if ($request->filled('transmission')) {
            $query->whereHas('variant', function ($query) use ($request) {
                $query->where('transmission', $request->transmission);
            });
        }

        if ($request->filled('sort')) {

            match ($request->sort) {

                'price_asc' => $query->orderBy('price_per_day', 'asc'),

                'price_desc' => $query->orderBy('price_per_day', 'desc'),

                'year_asc' => $query->orderBy('year', 'asc'),

                'year_desc' => $query->orderBy('year', 'desc'),

                default => $query->latest(),
            };
        } else {
            $query->orderBy('price_per_day', 'desc');
        }

        $cars = $query->paginate(
            $request->integer('per_page', 12)
        );


        return CarCardResource::collection($cars);
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

        return CarCardResource::collection($cars);
    }
}
