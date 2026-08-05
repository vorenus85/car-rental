<?php

namespace App\Http\Controllers\Admin\Fleet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Fleet\Location\StoreLocationRequest;
use App\Http\Requests\Admin\Fleet\Location\UpdateLocationRequest;
use App\Models\Fleet\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        $locations = Location::select(
            'id',
            'name',
            'country',
            'city_id',
            'type',
            'phone',
            'updated_at'
        )
            ->with('cityModel:id,name')
            ->withCount([
                'cars as total_cars_count',
                'cars as available_cars_count' => function ($query) {
                    $query->where('status', 'available');
                },
                'cars as rented_cars_count' => function ($query) {
                    $query->where('status', 'rented');
                },
                'cars as maintenance_cars_count' => function ($query) {
                    $query->where('status', 'maintenance');
                },
            ])
            ->orderBy('name')
            ->get();

        return response()->json($locations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request): JsonResponse
    {
        //
        $location = Location::create($request->validated());

        return response()->json($location->load('cityModel:id,name'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location): JsonResponse
    {
        return response()->json($location->load('cityModel:id,name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location): JsonResponse
    {
        //
        $location->update($request->validated());

        return response()->json($location->load('cityModel:id,name'));
    }

    /**
     * Use for location select on car crud pages
     */
    public function options(): JsonResponse
    {
        $locations = Location::query()
            ->select(['id', 'name'])
            ->get();

        return response()->json($locations);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location): Response
    {
        //
        $location->delete();

        return response()->noContent();
    }

    public function toggleActive(Location $location): JsonResponse
    {
        $location->active = ! $location->active;
        $location->save();

        return response()->json($location);
    }
}
