<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json([
            'appName' => 'Laravel Vue REST Starter',
            'version' => '1.0.0',
            'message' => 'Hello from the API!',
            'features' => [
                'Laravel 11',
                'Vue 3',
                'Pinia',
                'PrimeVue',
                'REST API structure',
            ]
        ]);
    }
}
