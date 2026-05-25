<?php

use App\Models\Fleet\Brand;
use App\Models\Fleet\CarModel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

describe('BrandController', function () {

    // index
    it('can fetch brands', function () {

        Brand::factory()->create([
            'name' => 'BMW',
        ]);

        Brand::factory()->create([
            'name' => 'Audi',
        ]);

        $response = $this->getJson('/api/admin/brands');

        $response
            ->assertOk()
            ->assertJsonCount(2)
            ->assertJsonFragment([
                'name' => 'Audi',
            ])
            ->assertJsonFragment([
                'name' => 'BMW',
            ]);
    });

    it('can fetch brands with images', function () {

        Brand::factory()->create([
            'name' => 'BMW',
            'image' => 'bmw.png',
        ]);

        $response = $this->getJson('/api/admin/brands?with_images=1');

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => 'BMW',
                'image' => 'bmw.png',
            ]);
    });

    // store
    it('can create a brand', function () {

        $payload = [
            'name' => 'Mercedes',
            'image' => 'mercedes.png',
            '_token' => 'test-token',
        ];

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/api/admin/brands', $payload);

        $response
            ->assertCreated()
            ->assertJsonFragment([
                'name' => 'Mercedes',
            ]);

        $this->assertDatabaseHas('brands', [
            'name' => 'Mercedes',
            'image' => 'mercedes.png',
        ]);
    });

    it('validates required fields when creating brand', function () {

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/api/admin/brands', ['_token' => 'test-token',]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'name',
            ]);
    });

    // show
    it('can fetch single brand', function () {

        Storage::fake('public');

        $brand = Brand::factory()->create([
            'name' => 'BMW',
            'image' => 'bmw.png',
        ]);

        $response = $this->getJson("/api/admin/brands/{$brand->id}");

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => 'BMW',
                'image' => 'bmw.png',
            ])
            ->assertJsonStructure([
                'image_url',
            ]);
    });

    // update
    it('can update a brand', function () {

        $brand = Brand::factory()->create([
            'name' => 'BMW',
        ]);

        $payload = [
            'name' => 'Mercedes',
            'image' => 'mercedes.png',
            '_token' => 'test-token',
        ];

        $response = $this->withSession(['_token' => 'test-token'])->putJson(
            "/api/admin/brands/{$brand->id}",
            $payload
        );

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => 'Mercedes',
            ]);

        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'name' => 'Mercedes',
            'image' => 'mercedes.png',
        ]);
    });

    it('validates required fields when updating brand', function () {

        $brand = Brand::factory()->create();

        $response = $this->withSession(['_token' => 'test-token'])->putJson(
            "/api/admin/brands/{$brand->id}",
            [
                'name' => '',
                '_token' => 'test-token',
            ]
        );

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'name',
            ])->assertJsonCount(1, 'errors');;
    });

    // destroy
    it('can delete a brand', function () {

        $brand = Brand::factory()->create();

        $response = $this->withSession(['_token' => 'test-token'])->deleteJson(
            "/api/admin/brands/{$brand->id}",
            ['_token' => 'test-token']
        );

        $response->assertNoContent();

        $this->assertDatabaseMissing('brands', [
            'id' => $brand->id,
        ]);
    });

    it('cannot delete a brand with models', function () {

        $brand = Brand::factory()->create();

        CarModel::factory()->create([
            'brand_id' => $brand->id,
        ]);

        $response = $this->withSession(['_token' => 'test-token'])->deleteJson(
            "/api/admin/brands/{$brand->id}",
            ['_token' => 'test-token']
        );

        $response
            ->assertStatus(422)
            ->assertJsonFragment([
                'message' => 'Brand cannot be deleted because it has associated models.',
            ]);

        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
        ]);
    });
});
