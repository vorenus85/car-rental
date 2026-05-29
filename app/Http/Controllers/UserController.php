<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = User::query()->orderBy('name', 'asc');

        $users = $query->get();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => "string|required",
            "phone" => "nullable|string",
            "email" => "string|required|email|unique:users,email",
        ], [
            'email.unique' => 'This email already exists.'
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'active' => true,
            'email' => $request->email
        ]);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $query = User::where("id", $user->id);

        return response()->json($query->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $request->validate([
            "name" => "string|required",
            "phone" => "nullable|string",
            "active" => "boolean",
            "email" => "string|required|email|unique:users,email," . $user->id,
        ], [
            'email.unique' => 'This email already exists.'
        ]);

        $user->update($request->all());

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function toggleActive(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        return response()->json($user);
    }
}
