<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\ChangePasswordRequest;
use App\Http\Requests\Admin\Account\UpdateAccountRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public function show()
    {
        $user  = Auth::guard('admin')->user();

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request)
    {
        $user = Auth::guard('admin')->user();

        $validated = $request->validated();

        $user->update($validated);

        return response()->json($user);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->validated();

        $user = Auth::guard('admin')->user();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            "message" => "Password changed successfully."
        ], 201);
    }
}
