<?php

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('User model', function () {

    it('has correct fillable attributes', function () {
        $user = new User();

        expect($user->getFillable())
            ->toBe([
                'name',
                'email',
                'phone',
                'password',
                'active',
            ]);
    });

    it('has correct hidden attributes', function () {
        $user = new User();

        expect($user->getHidden())
            ->toBe([
                'password',
                'remember_token',
            ]);
    });

    it('sends password reset notification', function () {
        Notification::fake();

        $user = User::factory()->create();

        $user->sendPasswordResetNotification('test-token');

        Notification::assertSentTo(
            $user,
            ResetPasswordNotification::class
        );
    });
});
