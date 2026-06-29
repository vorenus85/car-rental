<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    $this->actingAs($this->user);
});

describe('AccountController', function () {
    it('can show account details', function () {
        $response = $this->getJson('/api/admin/account/me');

        $response
            ->assertOk()
            ->assertJson([
                'id' => $this->user->id,
                'name' => $this->user->name,
                'phone' => $this->user->phone,
                'email' => $this->user->email,
            ]);
    });

    it('can update account details', function () {
        $payload = [
            "name" => "John Doe",
            "phone" => "123-456-7890",
            "email" => "john.doe@example.com",
            '_token' => 'test-token',
        ];

        $response = $this->withSession(['_token' => 'test-token'])->putJson('/api/admin/account/me', $payload);

        $response->assertOk()->assertJson([
            'id' => $this->user->id,
            'name' => $payload['name'],
            'phone' => $payload['phone'],
            'email' => $payload['email'],
        ]);
    });

    it('can change password', function () {
        $payload = [
            "current_password" => "password123",
            "password" => "newpassword456",
            "password_confirmation" => "newpassword456",
            '_token' => 'test-token',
        ];

        $response = $this->withSession(['_token' => 'test-token'])->putJson('/api/admin/account/password', $payload);

        $response
            ->assertCreated()
            ->assertJson([
                "message" => "Password changed successfully."
            ]);

        // Verify that the password was actually changed
        $this->assertTrue(Hash::check($payload['password'], $this->user->fresh()->password));
    });
});
