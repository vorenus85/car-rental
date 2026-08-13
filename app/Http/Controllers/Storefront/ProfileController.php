<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storefront\ChangePasswordRequest;
use App\Http\Requests\Storefront\EditBasicDetailsRequest;
use App\Http\Resources\Storefront\CustomerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editBasicDetails(EditBasicDetailsRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $customer = Auth::guard('customer')->user();

        $customer->update($validated);

        return response()->json([
            'message' => 'Basic details updated successfully.',
            'customer' => new CustomerResource($customer->refresh()),
        ]);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $customer = Auth::guard('customer')->user();

        $customer->update([
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'message' => 'Password changed successfully.',
        ]);
    }
}
