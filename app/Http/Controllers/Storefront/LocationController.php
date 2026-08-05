<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Fleet\Location;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function index(): JsonResponse
    {
        $locations = Location::query()
            ->select(['id', 'name', 'city_id', 'country'])
            ->with('cityModel:id,name')
            ->where('active', true)
            ->orderBy('country', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($locations);
    }
}
