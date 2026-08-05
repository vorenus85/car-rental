<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Resources\Storefront\BrandResource;
use App\Models\Fleet\Brand;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BrandController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $brands = Brand::select('id', 'name')->orderBy('name', 'asc')->get();

        return BrandResource::collection($brands);
    }
}
