<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $features = Feature::select('id', 'name', 'description', 'category')->orderBy('name', 'asc')->get();

        return response()->json($features);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'description' => 'string',
        ]);


        $feature = Feature::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return response()->json($feature, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        //
        return response()->json($feature);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'description' => 'string',
        ]);

        $feature->update($validated);

        return response()->json($feature, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        //
        $result = $feature->delete();

        return response()->json(['result' => $result], 200);
    }
}
