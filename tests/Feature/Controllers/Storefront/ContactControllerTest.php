<?php

use App\Notifications\Storefront\ContactMessageNotification;
use Illuminate\Support\Facades\Notification;

describe('ContactController', function () {
    it('sends contact form message', function () {
        Notification::fake();

        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+36 30 123 4567',
            'subject' => 'Reservation question',
            'message' => 'Hello, I would like to ask about a booking.',
        ];

        $response = $this->withSession(['_token' => 'test-token'])->postJson('/api/storefront/contact', [
            ...$payload,
            '_token' => 'test-token',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'message' => 'Thanks! Your message has been sent.',
            ]);

        Notification::assertSentOnDemand(
            ContactMessageNotification::class,
            function (ContactMessageNotification $notification, array $channels, object $notifiable) use ($payload) {
                return $channels === ['mail']
                    && $notifiable->routes['mail'] === config('services.contact.email')
                    && $notification->messageData === $payload;
            }
        );
    });

    it('builds contact notification', function () {
        $notification = new ContactMessageNotification([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+36 30 123 4567',
            'subject' => 'Reservation question',
            'message' => 'Hello, I would like to ask about a booking.',
        ]);

        $mail = $notification->toMail((object) []);

        expect($mail->subject)
            ->toBe('New contact form message: Reservation question');
    });

    it('validates required fields', function () {
        $response = $this->withSession(['_token' => 'test-token'])->postJson('/api/storefront/contact', [
            '_token' => 'test-token',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'subject', 'message']);
    });
});
