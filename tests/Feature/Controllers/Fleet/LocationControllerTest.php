<?php

use App\Models\Fleet\Location;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

describe('LocationController', function () {

    it('can list locations', function () {

        Location::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/locations');

        $response
            ->assertOk()
            ->assertJsonCount(3);
    });

    it('can show a single location', function () {

        $location = Location::factory()->create();

        $response = $this->getJson(
            "/api/admin/locations/{$location->id}"
        );

        $response
            ->assertOk()
            ->assertJson([
                'id' => $location->id,
            ]);
    });

    it('can create a location', function () {

        $payload = [
            'name' => 'Budapest Airport',
            'city' => 'Budapest',
            'country' => 'hu',
            'address' => 'Airport Road 1',
            'type' => 'airport',
            'phone' => '+36123456789',
            'email' => 'airport@test.com',
            'description' => 'Main airport',
            'active' => true,
            '_token' => 'test-token',
        ];

        $response = $this
            ->withSession(['_token' => 'test-token'])
            ->postJson('/api/admin/locations', $payload);

        $response
            ->assertCreated()
            ->assertJsonFragment([
                'name' => 'Budapest Airport',
            ]);

        $this->assertDatabaseHas('locations', [
            'name' => 'Budapest Airport',
        ]);
    });

    it('validates required fields when creating location', function () {

        $response = $this
            ->withSession(['_token' => 'test-token'])
            ->postJson('/api/admin/locations', [
                '_token' => 'test-token',
            ]);

        $response
            ->assertUnprocessable();

        $response->assertJsonValidationErrors([
            'name',
        ]);
    });

    it('can update a location', function () {

        $location = Location::factory()->create();

        $payload = [
            'name' => 'Vienna Airport',
            'city' => 'Vienna',
            'country' => 'at',
            'address' => 'Airport Road 2',
            'type' => 'airport',
            'phone' => '+43123456789',
            'email' => 'vienna@test.com',
            'description' => 'Updated description',
            'active' => false,
            '_token' => 'test-token',
        ];

        $response = $this
            ->withSession(['_token' => 'test-token'])
            ->putJson(
                "/api/admin/locations/{$location->id}",
                $payload
            );

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => 'Vienna Airport',
            ]);

        $this->assertDatabaseHas('locations', [
            'id' => $location->id,
            'name' => 'Vienna Airport',
        ]);
    });

    it('can delete a location', function () {

        $location = Location::factory()->create();

        $response = $this
            ->withSession(['_token' => 'test-token'])
            ->deleteJson(
                "/api/admin/locations/{$location->id}",
                ['_token' => 'test-token']
            );

        $response->assertNoContent();

        $this->assertDatabaseMissing('locations', [
            'id' => $location->id,
        ]);
    });

    it('can activate an inactive location', function () {

        $location = Location::factory()->create([
            'active' => false,
        ]);

        $response = $this->withSession(['_token' => 'test-token'])->putJson(
            "/api/admin/locations/{$location->id}/toggle-active",
            [
                '_token' => 'test-token',
            ]
        );

        $response
            ->assertOk()
            ->assertJsonFragment([
                'active' => true,
            ]);

        $this->assertDatabaseHas('locations', [
            'id' => $location->id,
            'active' => true,
        ]);
    });

    it('can deactivate an active location', function () {

        $location = Location::factory()->create([
            'active' => true,
        ]);

        $response = $this->withSession(['_token' => 'test-token'])->putJson(
            "/api/admin/locations/{$location->id}/toggle-active",
            [
                '_token' => 'test-token',
            ]
        );

        $response
            ->assertOk()
            ->assertJsonFragment([
                'active' => false,
            ]);

        $this->assertDatabaseHas('locations', [
            'id' => $location->id,
            'active' => false,
        ]);
    });
});
