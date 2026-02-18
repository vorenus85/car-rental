<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cars = Car::all();

        return response()->json($cars);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'model_id' => 'required|string',
            'licence_plate' => 'required|unique:cars,licence_plate|string',
            'image' => 'nullable|string',
            'price_per_day' => 'required|numeric',
            'body_type' => 'required|string',
            'transmission' => 'required|string',
            'fuel' => 'required|string',
            'status' => 'required|string',
            'production_year' => 'required|numeric',
            'top_speed' => 'required|numeric',
            'acceleration' => ['required', 'numeric', 'between:0,20'],
            'range' => 'required|numeric',
            'description' => 'nullable|string|max:500',
        ]);

        $car = Car::create([
            'model_id' => $request->model_id,
            'licence_plate' => $request->licence_plate,
            'image' => $request->image,
            'price_per_day' => $request->price_per_day,
            'body_type' => $request->body_type,
            'transmission' => $request->transmission,
            'fuel' => $request->fuel,
            'status' => $request->status,
            'production_year' => $request->production_year,
            'top_speed' => $request->top_speed,
            'acceleration' => $request->acceleration,
            'range' => $request->range,
            'description' => $request->description,
        ]);

        return response()->json($car, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
        return response()->json($car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
        $validated = $request->validate([
            'model_id' => 'required|string',
            'licence_plate' => 'required|string|unique:cars,licence_plate,'.$car->id,
            'image' => 'nullable|string',
            'price_per_day' => 'required|numeric',
            'body_type' => 'required|string',
            'transmission' => 'required|string',
            'fuel' => 'required|string',
            'status' => 'required|string',
            'production_year' => 'required|numeric',
            'top_speed' => 'required|numeric',
            'capacity' => 'required|numeric',
            'acceleration' => ['required', 'numeric', 'between:0,20'],
            'range' => 'required|numeric',
            'description' => 'nullable|string|max:500',
        ]);

        $car->update($validated);

        return response()->json($car, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
        $car->delete();

        return response()->json([ 'status' => 'ok' ], 200);
    }
}
