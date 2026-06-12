<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Resources\Storefront\CarModuleResource;
use App\Models\Fleet\Car;
use Illuminate\Support\Facades\Storage;

class CarModuleController extends Controller
{
    //
    public function randomCars()
    {
        $cars = Car::query()
            ->select([
                'id',
                'price_per_day',
                'status',
                'image',
                'variant_id',
            ])
            ->with([
                'variant:id,name,model_id,category,transmission,fuel,seats,luggage_count',
                'variant.model:id,name,brand_id',
                'variant.model.brand:id,name'
            ])
            ->where('status', 'available')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        return response()->json(CarModuleResource::collection($cars));
    }
}
