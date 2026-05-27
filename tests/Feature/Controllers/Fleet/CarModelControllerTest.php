<?php

use App\Models\Fleet\Brand;
use App\Models\Fleet\CarModel;
use App\Models\Fleet\Variant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

describe('CarModelController', function () {

    it('can list car models', function () {

        CarModel::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/car-models');

        $response
            ->assertOk()
            ->assertJsonCount(3, 'data');
    });

    it('can show a single car model', function () {

        $carModel = CarModel::factory()->create();

        $response = $this->getJson("/api/admin/car-models/{$carModel->id}");

        $response
            ->assertOk()
            ->assertJson([
                'id' => $carModel->id,
                'brand_id' => $carModel->brand_id,
                'name' => $carModel->name,
                'description' => $carModel->description,
            ]);
    });

    it('can create a car model', function () {

        $brand = Brand::factory()->create();

        $payload = [
            'brand_id' => $brand->id,
            'name' => 'Corolla',
            'description' => 'Compact family car',
            '_token' => 'test-token',
        ];

        $response = $this
            ->withSession(['_token' => 'test-token'])
            ->postJson('/api/admin/car-models', $payload);

        $response
            ->assertCreated()
            ->assertJsonFragment([
                'name' => 'Corolla',
                'description' => 'Compact family car',
            ]);

        $this->assertDatabaseHas('car_models', [
            'name' => 'Corolla',
        ]);
    });

    it('validates required fields when creating car model', function () {

        $response = $this
            ->withSession(['_token' => 'test-token'])
            ->postJson('/api/admin/car-models', [
                '_token' => 'test-token',
            ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'brand_id',
                'name',
            ]);
    });

    it('can update a car model', function () {

        $carModel = CarModel::factory()->create();

        $payload = [
            'brand_id' => $carModel->brand_id,
            'name' => 'Updated Model',
            'description' => 'Updated description',
            '_token' => 'test-token',
        ];

        $response = $this
            ->withSession(['_token' => 'test-token'])
            ->putJson(
                "/api/admin/car-models/{$carModel->id}",
                $payload
            );

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => 'Updated Model',
            ]);

        $this->assertDatabaseHas('car_models', [
            'id' => $carModel->id,
            'name' => 'Updated Model',
        ]);
    });

    it('can delete a car model without variants', function () {

        $carModel = CarModel::factory()->create();

        $response = $this
            ->withSession(['_token' => 'test-token'])
            ->deleteJson(
                "/api/admin/car-models/{$carModel->id}",
                ['_token' => 'test-token']
            );

        $response->assertNoContent();

        $this->assertDatabaseMissing('car_models', [
            'id' => $carModel->id,
        ]);
    });

    it('cannot delete a car model with assigned variants', function () {

        $carModel = CarModel::factory()->create();

        Variant::factory()->create([
            'model_id' => $carModel->id,
        ]);

        $response = $this
            ->withSession(['_token' => 'test-token'])
            ->deleteJson(
                "/api/admin/car-models/{$carModel->id}",
                ['_token' => 'test-token']
            );

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'Cannot delete car model with assigned variants.',
            ]);

        $this->assertDatabaseHas('car_models', [
            'id' => $carModel->id,
        ]);
    });

    it('can list car model options by brand id', function () {

        $brand = Brand::factory()->create();

        CarModel::factory()->count(2)->create([
            'brand_id' => $brand->id,
        ]);

        $response = $this->getJson(
            "/api/admin/car-models/options?brand_id={$brand->id}"
        );

        $response
            ->assertOk()
            ->assertJsonCount(2);
    });
});
