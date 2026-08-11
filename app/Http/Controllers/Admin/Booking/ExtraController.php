<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Extra\StoreExtraRequest;
use App\Http\Requests\Admin\Extra\UpdateExtraRequest;
use App\Http\Resources\Admin\ExtraResource;
use App\Models\Booking\Extra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        $extras = Extra::orderBy('name', 'asc')->get();

        return response()->json(ExtraResource::collection($extras), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExtraRequest $request): JsonResponse
    {
        //
        $validated = $request->validated();

        $extra = Extra::create($validated);

        return response()->json(new ExtraResource($extra), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Extra $extra): JsonResponse
    {
        //
        return response()->json(new ExtraResource($extra));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExtraRequest $request, Extra $extra): JsonResponse
    {
        //
        $validated = $request->validated();

        $extra->update($validated);

        return response()->json(new ExtraResource($extra), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extra $extra): Response
    {
        // todo check booking
        $extra->delete();

        return response()->noContent();
    }
}
