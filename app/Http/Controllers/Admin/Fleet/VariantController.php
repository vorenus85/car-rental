<?php

namespace App\Http\Controllers\Admin\Fleet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Fleet\Variant\VariantRequest;
use App\Models\Fleet\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $car_variants = Variant::query()
            ->select([
                'variants.id',
                'variants.name',
                'variants.model_id',
                'variants.category',
                'variants.fuel',
                'variants.transmission',
                'variants.seats',
                'variants.updated_at',
            ])
            ->join('car_models', 'variants.model_id', '=', 'car_models.id')
            ->join('brands', 'car_models.brand_id', '=', 'brands.id')
            ->with([
                'model:id,name,brand_id',
                'model.brand:id,name,image',
            ])
            ->orderBy('brands.name', 'asc')
            ->orderBy('car_models.name', 'asc')
            ->orderBy('variants.name', 'asc')
            ->get();

        return response()->json($car_variants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VariantRequest $request)
    {
        //
        $validated = $request->validated();

        $variant = Variant::create($validated);

        if ($request->has('features')) {
            $variant->features()->sync($request->features);
        }

        return response()->json([
            'message' => 'Variant created successfully.',
            'data' => $variant
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Variant $variant)
    {
        //
        return response()->json(
            $variant->load('model.brand')->load('features')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VariantRequest $request, Variant $variant)
    {
        //
        $validated = $request->validated();

        $variant->update($validated);

        if ($request->has('features')) {
            $variant->features()->sync($request->features);
        }

        return response()->json($variant, 200);
    }

    public function options(Request $request)
    {
        $model_id = $request->model_id;

        $variants = Variant::query()
            ->select(['id', 'name', 'model_id'])
            ->where('model_id', $model_id)
            ->with('model:id,name,brand_id')
            ->get();

        return response()->json($variants);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variant $variant)
    {
        //

        if ($variant->cars()->exists()) {
            return response()->json([
                'message' => 'Cannot delete variant with assigned cars.',
            ], 422);
        }

        $variant->delete();

        return response()->noContent();
    }
}
