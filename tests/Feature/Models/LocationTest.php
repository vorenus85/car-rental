<?php

use App\Models\Fleet\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Location model', function () {
    it('has correct fillable attributes', function () {
        $user = new Location();

        expect($user->getFillable())
            ->toBe([
                'name',
                'country',
                'city',
                'address',

                'latitude',
                'longitude',

                'type', // airport, railway_station, city_center, office, hotel, other

                'phone',
                'email',

                'business_hours',

                'image',
                'description',

                'active'
            ]);
    });
});
