<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Fleet\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::query()
            ->select(['id', 'name', 'city', 'country'])
            ->where("active", true)
            ->orderBy('country', 'asc')
            ->orderBy('city', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($locations);
    }
}
