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

describe('VariantController', function () {
    it('can list variant', function () {
        Variant::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/variants');

        $response
            ->assertOk()
            ->assertJsonCount(3);
    });

    it('can show a single variant', function () {
        $variant = Variant::factory()->create();

        $response = $this->getJson("/api/admin/variants/{$variant->id}");

        $response->assertOk()->assertJson([
            'id' => $variant->id,
            'model_id' => $variant->model_id,
            'name' => $variant->name,
            'category' => $variant->category,
            'description' => $variant->description,
            'body_type' => $variant->body_type,
            'transmission' => $variant->transmission,
            'fuel' => $variant->fuel,
            'seats' => $variant->seats,
            'doors' => $variant->doors,
            'luggage_count' => $variant->luggage_count,
            'range_km' => $variant->range_km,
        ]);
    });

    it('can create a variant', function () {

        $car_model = CarModel::factory()->create();

        $payload = [
            "name" => "Ultimate roadcaster 1.0",
            "category" => "economy",
            "description" => "An economical petrol engine with manual transmission, ideal for short city trips and low fuel consumption.",
            "model_id" => $car_model->id,
            "body_type" => "hatchback",
            "transmission" => "manual",
            "fuel" => "petrol",
            "seats" => 5,
            "doors" => 5,
            "luggage_count" => 3,
            "range_km" => 1000,
            '_token' => 'test-token',
        ];

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/api/admin/variants', $payload);

        $response->assertCreated()->assertJsonFragment([
            "name" => "Ultimate roadcaster 1.0",
            "category" => "economy",
            "description" => "An economical petrol engine with manual transmission, ideal for short city trips and low fuel consumption.",
            "model_id" => $car_model->id,
            "body_type" => "hatchback",
            "transmission" => "manual",
            "fuel" => "petrol",
            "seats" => 5,
            "doors" => 5,
            "luggage_count" => 3,
            "range_km" => 1000,
        ]);

        $this->assertDataBaseHas('variants', [
            "name" => $payload["name"],
        ]);
    });

    it('validates required fields when creating feature', function () {
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/api/admin/variants', ['_token' => 'test-token',]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'name',
                'model_id',
                'category',
                'body_type',
                'transmission',
                'fuel',
                'seats',
                'doors',
                'luggage_count',
                'range_km',
            ])->assertJsonCount(10, 'errors');
    });

    it('can update a variant', function () {
        $variant = Variant::factory()->create();

        $payload = [
            'model_id' => $variant->model_id,
            'name' => 'Updated Variant',
            'description' => 'Updated description',
            'category' => 'business',
            'body_type' => 'sedan',
            'transmission' => 'automatic',
            'fuel' => 'diesel',
            'seats' => 5,
            'doors' => 4,
            "luggage_count" => 3,
            "range_km" => 1000,
            '_token' => 'test-token',
        ];

        $response = $this->withSession(['_token' => 'test-token'])->putJson(
            "/api/admin/variants/{$variant->id}",
            $payload
        );

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => 'Updated Variant',
            ]);

        $this->assertDatabaseHas('variants', [
            'id' => $variant->id,
            'name' => 'Updated Variant',
        ]);
    });

    it('returns variants by model id with model relation', function () {
        $brand = Brand::factory()->create();

        $model = CarModel::factory()->create([
            'brand_id' => $brand->id,
        ]);

        $otherModel = CarModel::factory()->create([
            'brand_id' => $brand->id,
        ]);

        $variant1 = Variant::factory()->create([
            'name' => 'Variant A',
            'model_id' => $model->id,
        ]);

        $variant2 = Variant::factory()->create([
            'name' => 'Variant B',
            'model_id' => $model->id,
        ]);

        Variant::factory()->create([
            'name' => 'Should Not Be Returned',
            'model_id' => $otherModel->id,
        ]);

        $response = $this->getJson(
            "/api/admin/variants/options?model_id={$model->id}"
        );

        $response
            ->assertOk()
            ->assertJsonCount(2)
            ->assertJsonFragment([
                'id' => $variant1->id,
                'name' => 'Variant A',
                'model_id' => $model->id,
            ])
            ->assertJsonFragment([
                'id' => $variant2->id,
                'name' => 'Variant B',
                'model_id' => $model->id,
            ])
            ->assertJsonPath('0.model.id', $model->id)
            ->assertJsonPath('0.model.name', $model->name)
            ->assertJsonPath('0.model.brand_id', $brand->id);
    });

    it('can delete a variant', function () {
        $variant = Variant::factory()->create();

        $response = $this->withSession(['_token' => 'test-token'])->deleteJson(
            "/api/admin/variants/{$variant->id}",
            ['_token' => 'test-token',]
        );

        $response->assertNoContent();

        $this->assertDatabaseMissing('variants', ['id' => $variant->id]);
    });
});
