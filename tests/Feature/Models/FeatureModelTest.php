<?php

use App\Models\Fleet\Feature;
use App\Models\Fleet\Variant;
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

    it('has many variants relationship', function () {
        $feature = new Feature();

        expect($feature->variants())
            ->toBeInstanceOf(BelongsToMany::class);
    });

    it('can attach variants to feature', function () {
        $feature = Feature::factory()->create();

        $variants = Variant::factory()
            ->count(2)
            ->create();

        $feature->variants()->attach($variants);

        expect($feature->variants)
            ->toHaveCount(2);

        expect($feature->variants->first())
            ->toBeInstanceOf(Variant::class);
    });
});
