<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Password;

class UserCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $user)
    {
        //
        $this->user = $user;
    }

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
        $token = Password::broker('users')->createToken($this->user);

        $passwordSetupUrl = config('app.frontend_url')
            . '/admin/reset-password?token='
            . $token
            . '&email='
            . urlencode($this->user->email)
            . 'type=welcome';

        return (new MailMessage())
            ->subject('Welcome to DrivenGO')
            ->greeting('Welcome to the DrivenGO Team!')
            ->line('An administrator has created your account.')
            ->line('To activate your account, please set your password by clicking the button below.')
            ->action('Set Your Password', $passwordSetupUrl)
            ->line('This link is time-limited for your security.')
            ->line('If you were not expecting this email, please ignore it or contact your administrator.');
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
