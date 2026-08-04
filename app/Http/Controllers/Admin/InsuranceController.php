<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Insurance\StoreInsuranceRequest;
use App\Http\Requests\Admin\Insurance\UpdateInsuranceRequest;
use App\Http\Resources\Admin\InsuranceResource;
use App\Models\Insurance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        $insurances = Insurance::orderBy('name', 'asc')->get();

        return response()->json(InsuranceResource::collection($insurances), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInsuranceRequest $request): JsonResponse
    {
        //
        $validated = $request->validated();

        $insurance = Insurance::create($validated);

        return response()->json(new InsuranceResource($insurance), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Insurance $insurance): JsonResponse
    {
        //
        return response()->json(new InsuranceResource($insurance));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInsuranceRequest $request, Insurance $insurance): JsonResponse
    {
        //
        $validated = $request->validated();

        $insurance->update($validated);

        return response()->json(new InsuranceResource($insurance), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insurance $insurance): Response
    {
        // todo check booking
        $insurance->delete();

        return response()->noContent();
    }
}
