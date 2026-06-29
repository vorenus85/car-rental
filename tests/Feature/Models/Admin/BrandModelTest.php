<?php

use App\Models\Fleet\Brand;
use App\Models\Fleet\CarModel;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Brand model', function () {

    it('has fillable attributes', function () {
        $feature = new Brand();

        expect($feature->getFillable())
            ->toBe([
                'name',
                'image',
            ]);
    });

    it('has many models', function () {

        $brand = Brand::factory()->create();

        CarModel::factory()
            ->count(3)
            ->create([
                'brand_id' => $brand->id,
            ]);

        expect($brand->models)
            ->toHaveCount(3)
            ->each
            ->toBeInstanceOf(CarModel::class);
    });
});
