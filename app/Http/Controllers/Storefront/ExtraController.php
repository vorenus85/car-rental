<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Resources\Storefront\ExtraResource;
use App\Models\Extra;

class ExtraController extends Controller
{
    public function index()
    {
        $extras = Extra::orderBy('price', 'desc')->get();

        return ExtraResource::collection($extras);
    }
}
