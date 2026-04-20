<?php

namespace App\Http\Controllers\Fleet;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'model_id' => ['required', 'integer', 'exists:car_models,id'],

            'category' => ['required', 'in:economy,compact,suv,business,premium'],

            'description' => ['nullable', 'string'],

            'body_type' => ['required', 'in:suv,sedan,hatchback,coupe,wagon'],

            'transmission' => ['required', 'in:manual,automatic'],

            'fuel' => ['required', 'in:petrol,diesel,electric,hybrid'],

            'seats' => ['required', 'integer', 'min:1', 'max:9'],

            'doors' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $variant = Variant::create($validated);

        return response()->json([
            'message' => 'Variant created successfully.',
            'data' => $variant
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
        $result = $variant->delete();

        return response()->json(['result' => $result], 200);
    }
}
