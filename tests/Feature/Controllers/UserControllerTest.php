<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    $this->actingAs($this->user);
});

describe('UserController', function () {

    it('can list users', function () {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/users');

        $response
            ->assertOk()
            ->assertJsonCount(4); // 3 created + 1 from beforeEach
    });

    it('can create a user', function () {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
            '_token' => 'test-token',
        ];

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/api/admin/users', $data);

        $response
            ->assertCreated()
            ->assertJsonFragment([
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    });

    it('can show a user', function () {
        $user = User::factory()->create();

        $response = $this->getJson("/api/admin/users/{$user->id}");

        $response
            ->assertOk()
            ->assertJsonFragment([
                'id' => $user->id,
                'email' => $user->email,
            ]);
    });

    it('can update a user', function () {
        $user = User::factory()->create();

        $response = $this->withSession(['_token' => 'test-token'])->putJson("/api/admin/users/{$user->id}", [
            'name' => 'Updated Name',
            'email' => $user->email,
            '_token' => 'test-token',
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
        ]);
    });

    it('can delete a user', function () {
        $user = User::factory()->create();

        $response = $this->withSession(['_token' => 'test-token'])->deleteJson("/api/admin/users/{$user->id}", ['_token' => 'test-token',]);

        $response->assertNoContent();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    });

    it('can toggle active status', function () {
        $user = User::factory()->create([
            'active' => false,
        ]);

        $response = $this->withSession(['_token' => 'test-token'])->putJson("/api/admin/users/{$user->id}/toggle-active", ['_token' => 'test-token',]);

        $response
            ->assertOk()
            ->assertJsonFragment([
                'active' => true,
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'active' => true,
        ]);
    });
});
