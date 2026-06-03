<?php

use App\Models\Fleet\Brand;
use App\Models\Fleet\Car;
use App\Models\Fleet\CarModel;
use App\Models\Fleet\Variant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);

    $this->brand = Brand::factory()->create();

    $this->model = CarModel::factory()->create([
        'brand_id' => $this->brand->id,
    ]);

    $this->variant = Variant::factory()->create([
        'model_id' => $this->model->id,
    ]);
});

describe('CarController', function () {
    it('returns cars list', function () {
        Car::factory()->count(3)->create([
            'variant_id' => $this->variant->id,
        ]);

        $response = $this->getJson('/api/admin/cars');

        $response
            ->assertOk()
            ->assertJsonCount(3);
    });

    it('stores a car', function () {
        $payload = [
            'variant_id' => $this->variant->id,
            'licence_plate' => 'ABC-123',
            'price_per_day' => 100,
            'status' => 'available',
            'production_year' => 2024,
            'mileage' => 1000,
            'color' => 'black',
            'description' => 'Test car',
            '_token' => 'test-token',
        ];

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/api/admin/cars', $payload);

        $response
            ->assertCreated()
            ->assertJsonFragment([
                'licence_plate' => 'ABC-123',
            ]);

        $this->assertDatabaseHas('cars', [
            'licence_plate' => 'ABC-123',
        ]);
    });

    it('shows a car', function () {
        $car = Car::factory()->create([
            'variant_id' => $this->variant->id,
        ]);

        $response = $this->getJson("/api/admin/cars/{$car->id}");

        $response
            ->assertOk()
            ->assertJsonPath('id', $car->id)
            ->assertJsonPath('variant.id', $this->variant->id);
    });

    it('updates a car', function () {
        $car = Car::factory()->create([
            'variant_id' => $this->variant->id,
            'color' => 'black',
        ]);

        $response = $this->withSession(['_token' => 'test-token'])->putJson("/api/admin/cars/{$car->id}", [
            'variant_id' => $this->variant->id,
            'licence_plate' => $car->licence_plate,
            'price_per_day' => $car->price_per_day,
            'status' => $car->status,
            'production_year' => $car->production_year,
            'mileage' => $car->mileage,
            'color' => 'red',
            '_token' => 'test-token',
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'color' => 'red',
        ]);
    });

    it('deletes a car', function () {
        $car = Car::factory()->create([
            'variant_id' => $this->variant->id,
        ]);

        $response = $this->withSession(['_token' => 'test-token'])->deleteJson("/api/admin/cars/{$car->id}", ['_token' => 'test-token']);

        $response->assertNoContent();

        $this->assertDatabaseMissing('cars', [
            'id' => $car->id,
        ]);
    });

    it('deletes image when car is deleted', function () {
        Storage::fake();

        Storage::put('uploads/test.jpg', 'content');

        $car = Car::factory()->create([
            'variant_id' => $this->variant->id,
            'image' => 'test.jpg',
        ]);

        $this->withSession(['_token' => 'test-token'])->deleteJson("/api/admin/cars/{$car->id}", ['_token' => 'test-token'])
            ->assertNoContent();

        Storage::assertMissing('uploads/test.jpg');

        $this->assertDatabaseMissing('cars', [
            'id' => $car->id,
        ]);
    });

    it('returns image url when image exists', function () {
        Storage::fake();

        $car = Car::factory()->create([
            'variant_id' => $this->variant->id,
            'image' => 'car.jpg',
        ]);

        $response = $this->getJson("/api/admin/cars/{$car->id}");

        $response
            ->assertOk()
            ->assertJsonStructure([
                'id',
                'image_url',
                'variant',
            ]);
    });
});
