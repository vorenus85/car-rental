<?php

namespace App\Http\Services\Admin;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    public function upload(
        UploadedFile $file,
        string $directory = 'uploads',
        ?string $disk = null,
    ): array {
        $disk ??= config('filesystems.default');

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs(
            $directory,
            $filename,
            $disk
        );

        return [
            'path' => $path,
            'filename' => $filename,
            'url' => Storage::disk($disk)->url($path),
        ];
    }

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
