<?php

use App\Models\Fleet\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

describe('FeatureController', function () {

    it('can list features', function () {
        Feature::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/features');

        $response
            ->assertOk()
            ->assertJsonCount(3);
    });

    it('can show a single feature', function () {
        $feature = Feature::factory()->create();

        $response = $this->getJson("/api/admin/features/{$feature->id}");

        $response
            ->assertOk()
            ->assertJson([
                'id' => $feature->id,
                'name' => $feature->name,
                'category' => $feature->category,
            ]);
    });

    it('can create a feature', function () {
        $payload = [
            'name' => 'Adaptive Cruise Control',
            'category' => 'safety',
            'description' => 'Advanced driving assistance system',
            '_token' => 'test-token',
        ];

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/api/admin/features', $payload);

        $response
            ->assertCreated()
            ->assertJsonFragment([
                'name' => $payload['name'],
                'category' => $payload['category'],
            ]);

        $this->assertDatabaseHas('features', [
            'name' => $payload['name'],
        ]);
    });

    it('validates required fields when creating feature', function () {
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/api/admin/features', ['_token' => 'test-token',]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'name',
                'category',
            ])->assertJsonCount(2, 'errors');
    });

    it('can update a feature', function () {
        $feature = Feature::factory()->create();

        $payload = [
            'name' => 'Updated Feature',
            'category' => 'comfort',
            'description' => 'Updated description',
            '_token' => 'test-token',
        ];

        $response = $this->withSession(['_token' => 'test-token'])->putJson(
            "/api/admin/features/{$feature->id}",
            $payload
        );

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => 'Updated Feature',
            ]);

        $this->assertDatabaseHas('features', [
            'id' => $feature->id,
            'name' => 'Updated Feature',
        ]);
    });

    it('can delete a feature', function () {
        $feature = Feature::factory()->create();

        $response = $this->withSession(['_token' => 'test-token'])->deleteJson(
            "/api/admin/features/{$feature->id}",
            ['_token' => 'test-token',]
        );

        $response->assertNoContent();

        $this->assertDatabaseMissing('features', [
            'id' => $feature->id,
        ]);
    });
});
