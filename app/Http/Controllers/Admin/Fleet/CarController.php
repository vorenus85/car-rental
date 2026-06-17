<?php

namespace App\Http\Controllers\Admin\Fleet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Fleet\Car\StoreCarRequest;
use App\Http\Requests\Admin\Fleet\Car\UpdateCarRequest;
use App\Http\Resources\Admin\CarResource;
use App\Models\Fleet\Car;
use Illuminate\Support\Facades\Storage;

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
                'image',
                'updated_at',
                'variant_id',
                'location_id',
            ])
            ->with('location:id,name,city_id')
            ->with('location.cityModel:id,name')
            ->with([
                'variant:id,name,model_id,category',
                'variant.model:id,name,brand_id',
                'variant.model.brand:id,name'
            ])
            ->with('features:id,name,category')
            ->get();

        return response()->json(CarResource::collection($cars), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $validated = $request->validated();
        $featureIds = $validated['features'] ?? null;
        unset($validated['features']);

        $car = Car::create($validated);

        if ($featureIds !== null) {
            $car->features()->sync($featureIds);
        }

        return response()->json($car->load('features'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
        $result = Car::where('id', $car->id)->with([
            'variant:id,name,model_id,category,body_type,transmission,fuel,seats,doors',
            'variant.model:id,name,brand_id',
            'variant.model.brand:id',
            'features:id,name',
        ])->first();

        $result['image_url'] = $result->image ? Storage::url('/uploads/' . $result->image) : "";

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        //
        $validated = $request->validated();
        $featureIds = $validated['features'] ?? null;
        unset($validated['features']);

        if (empty($validated['image'])) {
            unset($validated['image']);
        }

        $car->update($validated);

        if ($featureIds !== null) {
            $car->features()->sync($featureIds);
        }

        return response()->json($car->load('features'), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {

        if ($car->image) {
            Storage::delete('uploads/' . $car->image);
        }

        $car->delete();

        return response()->noContent();
    }
}
