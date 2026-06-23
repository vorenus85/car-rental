<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Resources\Storefront\BrandResource;
use App\Models\Fleet\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::select('id', 'name')->orderBy('name', 'asc')->get();

        return BrandResource::collection($brands);
    }
}
