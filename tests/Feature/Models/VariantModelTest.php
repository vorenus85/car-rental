<?php

use App\Models\Fleet\Car;
use App\Models\Fleet\CarModel;
use App\Models\Fleet\Variant;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Variant model', function () {

    it('has fillable attributes', function () {
        $variant = new Variant();

        expect($variant->getFillable())
            ->toBe([
                'name',
                'model_id',
                'category',
                'description',

                'body_type',
                'transmission',
                'fuel',

                'seats',
                'doors',
                'luggage_count',

                'range_km',
            ]);
    });

    it('belongs to a car model', function () {

        $model = CarModel::factory()->create();

        $variant = Variant::factory()->create([
            'model_id' => $model->id,
        ]);

        expect($variant->model)
            ->toBeInstanceOf(CarModel::class)
            ->id->toBe($model->id);
    });

    it('has many cars', function () {

        $variant = Variant::factory()->create();

        Car::factory()
            ->count(3)
            ->create([
                'variant_id' => $variant->id,
            ]);

        expect($variant->cars)
            ->toHaveCount(3)
            ->each
            ->toBeInstanceOf(Car::class);
    });

});
