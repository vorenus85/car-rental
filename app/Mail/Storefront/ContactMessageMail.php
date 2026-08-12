<?php

namespace App\Mail\Storefront;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @param  array{
     *     name: string,
     *     email: string,
     *     phone?: string|null,
     *     subject: string,
     *     message: string,
     * }  $messageData
     */
    public function __construct(public array $messageData) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact form: '.$this->messageData['subject'],
            replyTo: [
                new Address(
                    $this->messageData['email'],
                    $this->messageData['name']
                ),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.storefront.contact-message',
            with: [
                'messageData' => $this->messageData,
            ]
        );
    }
}
