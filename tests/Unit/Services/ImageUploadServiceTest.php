<?php

use App\Http\Services\Admin\ImageUploadService;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

describe('ImageUploadService', function () {

    it('can upload image', function () {

        Storage::fake('public');

        $service = new ImageUploadService();

        $file = UploadedFile::fake()->image('brand.jpg');

        $result = $service->upload(
            $file,
            'uploads',
            'public'
        );

        expect($result)
            ->toHaveKeys([
                'path',
                'filename',
                'url',
            ]);

        Storage::disk('public')->assertExists(
            $result['path']
        );

        expect($result['filename'])
            ->toEndWith('.jpg');

        expect($result['path'])
            ->toStartWith('uploads/');
    });

    it('can delete image', function () {

        Storage::fake('public');

        $service = new ImageUploadService();

        $file = UploadedFile::fake()->image('brand.jpg');

        $path = $file->store(
            'uploads',
            'public'
        );

        Storage::disk('public')->assertExists($path);

        $result = $service->delete(
            $path,
            'public'
        );

        expect($result)->toBeTrue();

        Storage::disk('public')->assertMissing($path);
    });

    it('returns false when deleting non existing image', function () {

        Storage::fake('public');

        $service = new ImageUploadService();

        $result = $service->delete(
            'uploads/missing.jpg',
            'public'
        );

        expect($result)->toBeFalse();
    });
});
