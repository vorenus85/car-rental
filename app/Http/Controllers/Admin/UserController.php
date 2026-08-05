<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User;
use App\Notifications\Admin\UserCreatedNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        $query = User::query()->orderBy('name', 'asc');

        $users = $query->get();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        //
        $validated = $request->validated();

        $user = User::create($validated);

        $user->notify(new UserCreatedNotification($user));

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        //
        $query = User::where('id', $user->id);

        return response()->json($query->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        //
        $validated = $request->validated();

        $user->update($validated);

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }

    public function toggleActive(User $user): JsonResponse
    {
        $user->active = ! $user->active;
        $user->save();

        return response()->json($user);
    }

    public function sendPasswordReset(User $user): JsonResponse
    {
        Password::sendResetLink([
            'email' => $user->email,
        ]);

        return response()->json([
            'message' => 'Password reset email sent.',
        ]);
    }
}
