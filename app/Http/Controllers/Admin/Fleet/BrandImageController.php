<?php

namespace App\Http\Controllers\Admin\Fleet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UploadImageRequest;
use App\Http\Services\Admin\ImageUploadService;
use App\Models\Fleet\Brand;

class BrandImageController extends Controller
{
    public function __construct(
        protected ImageUploadService $imageUploadService
    ) {}

    public function store(UploadImageRequest $request)
    {
        try {
            $result = $this->imageUploadService->upload(
                $request->file('file'),
                'uploads/'
            );

            return response()->json($result);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => 'error',
                'message' => 'Error during upload brand image',
            ], 500);
        }
    }

    public function delete(Brand $brand)
    {
        try {

            if (! $brand->image) {
                return response()->json([
                    'status' => 'error',
                ], 404);
            }

            $this->imageUploadService->delete(
                'uploads/' . $brand->image
            );

            $brand->update([
                'image' => null,
            ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => 'error',
                'message' => 'Error during delete brand image',
            ], 500);
        }
    }
}
