<?php

namespace App\Http\Services\Admin;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    /**
     * Uploads an image file and returns its details.
     *
     * @return array{path: string, filename: string, url: string}
     */
    public function upload(
        UploadedFile $file,
        string $directory = 'uploads',
        ?string $disk = null,
    ): array {
        $disk ??= config('filesystems.default');

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs($directory, $filename, $disk);

        /** @var FilesystemAdapter $storage */
        $storage = Storage::disk($disk);

        return [
            'path' => $path,
            'filename' => $filename,
            'url' => $storage->url($path),
        ];
    }

    /**
     * Deletes an image file.
     *
     * @return bool
     */
    public function delete(
        string $path,
        ?string $disk = null,
    ): bool {
        $disk ??= config('filesystems.default');

        if (! Storage::disk($disk)->exists($path)) {
            return false;
        }

        return Storage::disk($disk)->delete($path);
    }
}
