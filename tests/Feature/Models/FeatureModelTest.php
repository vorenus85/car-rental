<?php

use App\Models\Fleet\Car;
use App\Models\Fleet\Feature;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Feature model', function () {

    it('has fillable attributes', function () {
        $feature = new Feature();

        expect($feature->getFillable())
            ->toBe([
                'name',
                'description',
                'category',
            ]);
    });

    it('has many cars relationship', function () {
        $feature = new Feature();

        expect($feature->cars())
            ->toBeInstanceOf(BelongsToMany::class);
    });

    it('can attach cars to feature', function () {
        $feature = Feature::factory()->create();

        $cars = Car::factory()
            ->count(2)
            ->create();

        $feature->cars()->attach($cars);

        expect($feature->cars)
            ->toHaveCount(2);

        expect($feature->cars->first())
            ->toBeInstanceOf(Car::class);
    });
});
