<?php

use App\Models\User;
use App\Notifications\Admin\ResetPasswordNotification;

describe('ResetPasswordNotification', function () {
    it('uses mail channel', function () {
        $notification = new ResetPasswordNotification('test-token');

        expect(
            $notification->via(new User())
        )->toBe(['mail']);
    });

    it('builds reset password email', function () {
        config([
            'app.frontend_url' => 'https://frontend.test',
        ]);

        $user = User::factory()->make([
            'email' => 'john@example.com',
        ]);

        $notification = new ResetPasswordNotification('test-token');

        $mail = $notification->toMail($user);

        expect($mail->subject)
            ->toBe('Reset Your Password');

        expect($mail->actionText)
            ->toBe('Reset Password');

        expect($mail->actionUrl)
            ->toBe(
                'https://frontend.test/admin/reset-password?token=test-token&email=john@example.com'
            );
    });

    it('returns empty array representation', function () {
        $notification = new ResetPasswordNotification('token');

        expect(
            $notification->toArray(new User())
        )->toBe([]);
    });
});
