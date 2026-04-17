<?php

namespace App\Http\Controllers\Fleet;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Fleet\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Brand::query()->select('id', 'name')->orderBy('name', 'asc');

        if ($request->boolean('with_images')) {
            $query->addSelect('image');
        }

        $brands = $query->get();

        return response()->json(BrandResource::collection($brands), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'image' => 'string',
        ]);

        $brand = Brand::create([
            'name' => $request->name,
            'image' => $request->image,
        ]);

        return response()->json($brand, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
        $brand['image_url'] = $brand->image ? Storage::url('/uploads/' . $brand->image) : "";
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string',
            'image' => 'string',
        ]);

        $brand->update($validated);

        return response()->json($brand, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
        if ($brand->models()->exists()) {
            return response()->json([
                'message' => 'Brand cannot be deleted because it has associated models.',
            ], 422);
        }

        $result = $brand->delete();

        return response()->json(['result' => $result], 200);
    }
}
