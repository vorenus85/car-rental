<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
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
        if($request->boolean('minimal')){
            $brands = Brand::select('id', 'name')->orderBy('name', 'asc')->get();

            return response()->json($brands)->setStatusCode(200);
        }

        $brands = Brand::select('id', 'name','image')->orderBy('name', 'asc')->get();

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
            'image' => 'string'
        ]);

        $brand = Brand::create([
            'name' => $request->name,
            'image' => $request->image
        ]);

        return response()->json($brand, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
         $brand['image_url'] = $brand->image ? Storage::url('/uploads/'.$brand->image) : "";
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
            'image' => 'string'
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
        $brand->delete();

        return response()->json([ 'status' => 'ok' ], 200);
    }
}
