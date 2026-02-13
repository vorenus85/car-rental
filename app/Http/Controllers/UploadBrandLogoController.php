<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UploadBrandLogoController extends Controller
{
    //
     public function store(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $file = $request->file('file');

            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            $disk = config('filesystems.default'); // local or s3
            $path = $file->storeAs('uploads', $filename, $disk);

            return response()->json([
                'path' => $path,
                'filename' => $filename,
                'url' => Storage::disk($disk)->url($path),
            ]);
        } catch (\Throwable $th) {

            Log::error('Brand delete upload failed', [
                'user_id' => auth()->id(),
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            return response()->json([ 'status' => 'error', 'message' => 'Error during upload brand image' ], 500);
        }
    }

    public function delete(Brand $brand){
        try {
            if ($brand->image && Storage::exists('/uploads/'.$brand->image)) {
                Storage::delete('/uploads/'.$brand->image);
                $brand->update(["image" => ""]);
                return response()->json(["status" => 'ok']);
            }

            return abort(500);

        } catch (\Throwable $th) {

            Log::error('Brand delete image failed', [
                'user_id' => auth()->id(),
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            return response()->json([ 'status' => 'error', 'message' => 'Error during delete brand image' ], 500);
        }
    }
}
