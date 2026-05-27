<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('AuthController', function () {

    it('can login user', function () {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/auth/login', [
            'email' => 'john@example.com',
            'password' => 'password123',
            '_token' => 'test-token',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                ],
            ]);

        $this->assertAuthenticatedAs($user);
    });

    it('returns error with invalid credentials', function () {
        User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/auth/login', [
            'email' => 'john@example.com',
            'password' => 'wrong-password',
            '_token' => 'test-token',
        ]);

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials',
            ]);

        $this->assertGuest();
    });

    it('requires email when logging in', function () {
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/auth/login', [
            'password' => 'password123',
            '_token' => 'test-token',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });

    it('requires password when logging in', function () {
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/auth/login', [
            'email' => 'john@example.com',
            '_token' => 'test-token',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    });

    it('requires valid email format when logging in', function () {
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/auth/login', [
            'email' => 'invalid-email',
            'password' => 'password123',
            '_token' => 'test-token',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });

    it('can logout user', function () {
        $user = User::factory()->create();

        $response = $this
            ->withSession(['_token' => 'test-token'])
            ->actingAs($user)
            ->postJson('/auth/logout', [
                '_token' => 'test-token',
            ]);

        $response->assertNoContent();

        $this->assertGuest();
    });
});
