<?php

use App\Models\Fleet\Brand;
use App\Models\Fleet\Car;
use App\Models\Fleet\CarModel;
use App\Models\Fleet\Variant;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Car model', function () {
    it('has fillable attributes', function () {
        $carModel = new Car();

        expect($carModel->getFillable())
            ->toBe([
                'variant_id',
                'licence_plate',
                'image',
                'price_per_day',
                'status',
                'production_year',
                'mileage',
                'color',
                'description',
            ]);
    });

    it('can retrieve its variant', function () {
        $variant = Variant::factory()->create();

        $car = Car::factory()->create([
            'variant_id' => $variant->id,
        ]);

        expect($car->variant)->toBeInstanceOf(Variant::class);
        expect($car->variant->id)->toBe($variant->id);
    });
});
