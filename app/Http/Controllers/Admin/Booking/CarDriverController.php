<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CarDriver\StoreCarDriverRequest;
use App\Http\Requests\Admin\CarDriver\UpdateCarDriverRequest;
use App\Http\Resources\Admin\CarDriverResource;
use App\Models\Booking\CarDriver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CarDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $carDrivers = CarDriver::orderBy('last_name', 'asc')->get();

        return response()->json(CarDriverResource::collection($carDrivers), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarDriverRequest $request): JsonResponse
    {
        $carDriver = CarDriver::create($request->validated());

        return response()->json(new CarDriverResource($carDriver), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarDriver $carDriver): JsonResponse
    {
        return response()->json(new CarDriverResource($carDriver), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarDriverRequest $request, CarDriver $carDriver): JsonResponse
    {
        $carDriver->update($request->validated());

        return response()->json(new CarDriverResource($carDriver), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarDriver $carDriver): Response
    {
        $carDriver->delete();

        return response()->noContent();
    }
}
