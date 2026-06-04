<?php

namespace App\Http\Controllers\Fleet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fleet\Location\StoreLocationRequest;
use App\Http\Requests\Fleet\Location\UpdateLocationRequest;
use App\Models\Fleet\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $locations = Location::orderBy('name', 'asc')->get();
        return response()->json($locations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        //
        $location = Location::create($request->validated());
        return response()->json($location, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return response()->json($location);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        //
        $location->update($request->validated());
        return response()->json($location);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
        $location->delete();
        return response()->noContent();
    }

    public function toggleActive(Location $location)
    {
        $location->is_active = !$location->is_active;
        $location->save();

        return response()->json($location);
    }
}
