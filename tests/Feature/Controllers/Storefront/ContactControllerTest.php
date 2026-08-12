<?php

use App\Mail\Storefront\ContactMessageMail;
use Illuminate\Support\Facades\Mail;

describe('ContactController', function () {
    it('sends contact form message', function () {
        Mail::fake();

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

        Mail::assertSent(ContactMessageMail::class, function (ContactMessageMail $mail) use ($payload) {
            return $mail->hasTo(config('services.contact.email'))
                && $mail->envelope()->subject === 'Contact form: '.$payload['subject'];
        });
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
