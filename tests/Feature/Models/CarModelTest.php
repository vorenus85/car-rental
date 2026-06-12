<?php

use App\Models\Fleet\Brand;
use App\Models\Fleet\Car;
use App\Models\Fleet\CarModel;
use App\Models\Fleet\Feature;
use App\Models\Fleet\Variant;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Car model', function () {
    it('has fillable attributes', function () {
        $carModel = new Car();

        expect($carModel->getFillable())
            ->toBe([
                'variant_id',
                'location_id',
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

    it('can attach features to car', function () {
        $car = Car::factory()->create();

        $features = Feature::factory()
            ->count(2)
            ->create();

        $car->features()->attach($features);

        expect($car->features)
            ->toHaveCount(2);

        expect($car->features->first())
            ->toBeInstanceOf(Feature::class);

        expect($car->features())
            ->toBeInstanceOf(BelongsToMany::class);
    });
});
