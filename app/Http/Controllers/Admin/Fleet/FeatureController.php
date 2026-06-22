<?php

namespace App\Http\Controllers\Admin\Fleet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Fleet\Feature\StoreFeatureRequest;
use App\Http\Requests\Admin\Fleet\Feature\UpdateFeatureRequest;
use App\Http\Resources\Admin\FeatureResource;
use App\Models\Fleet\Feature;
use Illuminate\Http\Response;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $features = Feature::orderBy('name', 'asc')->get();

        return response()->json(FeatureResource::collection($features), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeatureRequest $request)
    {
        //
        $validated = $request->validated();

        $feature = Feature::create($validated);

        return response()->json(new FeatureResource($feature), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        //
        return response()->json(new FeatureResource($feature));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        //
        $validated = $request->validated();

        $feature->update($validated);

        return response()->json(new FeatureResource($feature), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature): Response
    {
        //
        $feature->delete();

        return response()->noContent();
    }
}
