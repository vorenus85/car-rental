<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fleet\Car;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function availableCarsKpi(): JsonResponse
    {
        $availableCars = Car::where('status', 'available')->count();

        return response()->json($availableCars);
    }
}
