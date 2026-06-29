<?php

use App\Models\Fleet\Brand;
use App\Models\Fleet\CarModel;
use App\Models\Fleet\Variant;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


describe('CarModel model', function () {
    it('has fillable attributes', function () {
        $carModel = new CarModel();

        expect($carModel->getFillable())
            ->toBe([
                'name',
                'description',
                'brand_id',
            ]);
    });


    it('belongs to a brand', function () {
        $brand = Brand::factory()->create();

        $carModel = CarModel::factory()->create(["brand_id" => $brand->id]);

        expect($carModel->brand)
            ->toBeInstanceOf(Brand::class)
            ->id->toBe($brand->id);
    });

    it('has many variant', function () {

        $carModel = CarModel::factory()->create();

        Variant::factory()
            ->count(3)
            ->create([
                'model_id' => $carModel->id,
            ]);

        expect($carModel->variants)
            ->toHaveCount(3)
            ->each
            ->toBeInstanceOf(Variant::class);
    });
});
