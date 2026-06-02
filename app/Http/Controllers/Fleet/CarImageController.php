<?php

namespace App\Http\Controllers\Fleet;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;
use App\Http\Services\ImageUploadService;
use App\Models\Fleet\Car;
use Illuminate\Http\Request;

class CarImageController extends Controller
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
                'message' => 'Error during upload car image',
            ], 500);
        }
    }

    public function delete(Car $car)
    {
        try {

            if (! $car->image) {
                return response()->json([
                    'status' => 'error',
                ], 404);
            }

            $this->imageUploadService->delete(
                'uploads/' . $car->image
            );

            $car->update([
                'image' => null,
            ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => 'error',
                'message' => 'Error during delete car image',
            ], 500);
        }
    }
}
