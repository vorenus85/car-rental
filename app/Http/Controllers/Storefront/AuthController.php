<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storefront\RegisterCustomerRequest;
use App\Models\Customer;
use App\Notifications\Storefront\CustomerCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $customer = Customer::where('email', $credentials['email'])->first();

        if (!$customer || !Hash::check($credentials['password'], $customer->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        if (!$customer->active) {
            return response()->json([
                'message' => 'Your account has been deactivated. Please contact an administrator.'
            ], 403);
        }

        Auth::guard('customer')->login($customer);

        $request->session()->regenerate();

        return response()->json([
            'customer' => $customer
        ]);
    }

    public function register(RegisterCustomerRequest $request)
    {
        //
        $validated = $request->validated();

        $customer = Customer::create($validated);

        $customer->notify(new CustomerCreatedNotification($customer));

        return response()->json($customer, 201);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->regenerateToken();

        return response()->noContent();
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        Password::broker('customers')->sendResetLink(
            $request->only('email')
        );

        return response()->json([
            'message' => 'We have emailed your password reset link.'
        ]);
    }

    public function reset(Request $request)
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
            'message' => 'Invalid token'
        ], 400);
    }
}
