<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarModelResource;
use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $carModels = CarModel::query()
        ->join('brands', 'car_models.brand_id', '=', 'brands.id')
        ->select('car_models.id', 'car_models.name', 'car_models.brand_id')
        ->with('brand')
        ->orderBy('brands.name', 'asc')
        ->orderBy('car_models.name', 'asc')
        ->get();
        return CarModelResource::collection($carModels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'name' => 'required|string',
            'brand_id' => 'required|int'
        ]);

        $carModel = CarModel::create([
            'name' => $request->name,
            'brand_id' => $request->brand_id
        ]);

        return response()->json($carModel, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModel $carModel)
    {
        //
        return response()->json($carModel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarModel $carModel)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string',
            'brand_id' => 'required|int'
        ]);

        $carModel->update($validated);

        return response()->json($carModel, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $carModel)
    {
        //
        $carModel->cars()->update(['model_id' => null]);
        $deleted = $carModel->delete();

        return response()->json([ 'status' => $deleted ? 'deleted' : 'failed', 'carModel' => $carModel ]);


    }
}
