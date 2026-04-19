<?php

namespace App\Http\Controllers\Fleet;

use App\Http\Controllers\Controller;
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
            ->select('car_models.id', 'car_models.name', 'car_models.description', 'car_models.brand_id')
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'description' => 'string',
            'brand_id' => 'required|int',
        ]);

        $carModel = CarModel::create([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'description' => $request->description,
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
            'description' => 'string',
            'brand_id' => 'required|int',
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
        if ($carModel->variants()->exists()) {
            return response()->json([
                'message' => 'Cannot delete car model with assigned variants.',
            ], 422);
        }

        $result = $carModel->delete();

        return response()->json(['result' => $result], 200);
    }
}
