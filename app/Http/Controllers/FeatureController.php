<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $features = Feature::all();

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
            'description' => 'string',
        ]);


        $feature = Feature::create([
            'name' => $request->name,
            'description' => $request->icon
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
            'description' => 'string'
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
        $feature->delete();

        return response()->json([ 'status' => 'ok' ], 200);
    }
}
