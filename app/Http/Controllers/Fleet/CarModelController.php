<?php

namespace App\Http\Controllers\Fleet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fleet\CarModel\StoreCarModelRequest;
use App\Http\Requests\Fleet\CarModel\UpdateCarModelRequest;
use App\Http\Resources\CarModelResource;
use App\Models\Fleet\CarModel;
use Illuminate\Http\Request;

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
            ->select('car_models.id', 'car_models.name', 'car_models.description', 'car_models.brand_id', 'car_models.updated_at')
            ->with('brand')
            ->orderBy('brands.name', 'asc')
            ->orderBy('car_models.name', 'asc')
            ->get();

        return CarModelResource::collection($carModels);
    }

    public function options(Request $request)
    {
        $brand_id = $request->brand_id;

        $carModels = CarModel::select('id', 'name', 'brand_id')->where('brand_id', $brand_id)->orderBy('name', 'asc')->get();

        return response()->json($carModels, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarModelRequest $request)
    {
        //
        $validated = $request->validated();

        $carModel = CarModel::create($validated);

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
    public function update(UpdateCarModelRequest $request, CarModel $carModel)
    {
        //
        $validated = $request->validated();

        $carModel->update($validated);

        return response()->json($carModel, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $carModel)
    {
        //
        if ($carModel->variants()->exists()) {
            return response()->json([
                'message' => 'Cannot delete car model with assigned variants.',
            ], 422);
        }

        $carModel->delete();

        return response()->noContent();
    }
}
