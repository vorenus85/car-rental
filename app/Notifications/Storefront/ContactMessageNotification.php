<?php

namespace App\Notifications\Storefront;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactMessageNotification extends Notification
{
    use Queueable;

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

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New contact form message: '.$this->messageData['subject'])
            ->greeting('You have a new contact form message')
            ->line('Name: '.$this->messageData['name'])
            ->line('Email: '.$this->messageData['email'])
            ->line('Phone: '.($this->messageData['phone'] ?: 'Not provided'))
            ->line('Subject: '.$this->messageData['subject'])
            ->line('Message:')
            ->line($this->messageData['message'])
            ->replyTo($this->messageData['email'], $this->messageData['name']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
