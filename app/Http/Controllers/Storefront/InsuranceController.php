<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Resources\Storefront\InsuranceResource;
use App\Models\Insurance;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InsuranceController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $insurances = Insurance::orderBy('price', 'desc')->get();

        return InsuranceResource::collection($insurances);
    }
}
