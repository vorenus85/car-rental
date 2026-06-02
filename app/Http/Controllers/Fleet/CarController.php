<?php

namespace App\Http\Controllers\Fleet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fleet\Car\StoreCarRequest;
use App\Http\Requests\Fleet\Car\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Fleet\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cars = Car::query()
            ->select([
                'id',
                'licence_plate',
                'price_per_day',
                'status',
                'production_year',
                'mileage',
                'production_year',
                'image',
                'updated_at',
                'variant_id'
            ])
            ->with([
                'variant:id,name,model_id,category',
                'variant.model:id,name,brand_id',
                'variant.model.brand:id,name'
            ])
            ->get();

        return response()->json(CarResource::collection($cars), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->validated());

        return response()->json($car, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
        return response()->json($car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        //
        $validated = $request->validated();

        $car->update($validated);

        return response()->json($car, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
        $car->delete();

        return response()->json(['status' => 'ok'], 200);
    }
}
