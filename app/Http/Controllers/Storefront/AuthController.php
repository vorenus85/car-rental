<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storefront\RegisterCustomerRequest;
use App\Http\Resources\Storefront\CustomerResource;
use App\Models\Booking\Customer;
use App\Notifications\Storefront\CustomerCreatedNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    //
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $customer = Customer::where('email', $credentials['email'])->first();

        if (! $customer || ! Hash::check($credentials['password'], $customer->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        if (! $customer->active) {
            return response()->json([
                'message' => 'Your account has been deactivated. Please contact an administrator.',
            ], 403);
        }

        Auth::guard('customer')->login($customer);

        $request->session()->regenerate();

        return response()->json([
            'customer' => new CustomerResource($customer),
        ]);
    }

    public function register(RegisterCustomerRequest $request): JsonResponse
    {
        //
        $validated = $request->validated();

        $customer = Customer::create($validated);

        $customer->notify(new CustomerCreatedNotification($customer));

        return response()->json([
            'customer' => new CustomerResource($customer),
        ], 201);
    }

    public function logout(Request $request): Response
    {
        Auth::guard('customer')->logout();

        $request->session()->regenerateToken();

        return response()->noContent();
    }

    public function sendResetLink(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        Password::broker('customers')->sendResetLink(
            $request->only('email')
        );

        return response()->json([
            'message' => 'We have emailed your password reset link.',
        ]);
    }

    public function reset(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('customers')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($customer, $password) {
                $customer->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password succesfully updated']);
        }

        return response()->json([
            'message' => 'Invalid token',
        ], 400);
    }
}
