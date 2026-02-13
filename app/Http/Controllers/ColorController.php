<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::select('id', 'name', 'hex_code')->orderBy('name', 'asc')->get();

        return response()->json($colors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'hex_code' => 'required|string'
        ]);

        $color = Color::create([
            'name' => $request->name,
            'hex_code' => $request->hex_code
        ]);

        return response()->json($color, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        return response()->json($color);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {

        $validated = $request->validate([
            'name' => 'required|string',
            'hex_code' => 'required|string'
        ]);

        $color->update($validated);

        return response()->json($color, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        $color->delete();

        return response()->json([ 'status' => 'ok' ], 200);
    }
}
