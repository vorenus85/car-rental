<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Resources\Storefront\ExtraResource;
use App\Models\Extra;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExtraController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $extras = Extra::orderBy('price', 'desc')->get();

        return ExtraResource::collection($extras);
    }
}
