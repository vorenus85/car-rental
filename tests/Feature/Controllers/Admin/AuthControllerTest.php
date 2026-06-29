<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

uses(RefreshDatabase::class);

describe('AuthController', function () {

    it('can login user', function () {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/login', [
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

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/login', [
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
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/login', [
            'password' => 'password123',
            '_token' => 'test-token',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });

    it('requires password when logging in', function () {
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/login', [
            'email' => 'john@example.com',
            '_token' => 'test-token',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    });

    it('requires valid email format when logging in', function () {
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/login', [
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
            ->postJson('/admin/auth/logout', [
                '_token' => 'test-token',
            ]);

        $response->assertNoContent();

        $this->assertGuest();
    });

    it('sends password reset link', function () {
        Password::shouldReceive('sendResetLink')
            ->once()
            ->andReturn(Password::RESET_LINK_SENT);

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/forgot-password', [
            'email' => 'john@example.com',
            '_token' => 'test-token',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'message' => 'We have emailed your password reset link.',
            ]);
    });

    it('requires email when sending reset link', function () {
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/forgot-password', [
            '_token' => 'test-token',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });

    it('validates email format when sending reset link', function () {
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/forgot-password', [
            'email' => 'invalid-email',
            '_token' => 'test-token',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });

    it('resets password successfully', function () {
        $user = User::factory()->create();

        Password::shouldReceive('reset')
            ->once()
            ->andReturnUsing(function ($credentials, $callback) use ($user) {
                $callback($user, 'newpassword123');

                return Password::PASSWORD_RESET;
            });

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/reset-password', [
            'token' => 'valid-token',
            '_token' => 'test-token',
            'email' => $user->email,
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'message' => 'Password succesfully updated',
            ]);

        expect(
            Hash::check(
                'newpassword123',
                $user->fresh()->password
            )
        )->toBeTrue();
    });

    it('returns error for invalid token', function () {
        Password::shouldReceive('reset')
            ->once()
            ->andReturn(Password::INVALID_TOKEN);

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/reset-password', [
            '_token' => 'test-token',
            'token' => 'invalid-token',
            'email' => 'john@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Invalid token',
            ]);
    });

    it('validates password confirmation', function () {
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/reset-password', [
            '_token' => 'test-token',
            'token' => 'token',
            'email' => 'john@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'differentpassword',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);
    });

    it('cannot login with inactive account', function () {
        $user = User::factory()->create([
            'active' => false,
            'password' => bcrypt('password'),
        ]);

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/admin/auth/login', [
            'email' => $user->email,
            'password' => 'password',
            '_token' => 'test-token',
        ]);

        $response
            ->assertStatus(403)
            ->assertJson([
                'message' => 'Your account has been deactivated. Please contact an administrator.',
            ]);
    });
});
