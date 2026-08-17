<?php

namespace App\Notifications\Storefront;

use App\Models\Booking\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingInvoiceNotification extends Notification
{
    use Queueable;

    public function __construct(public Booking $booking) {}

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
        $carImageUrl = $this->booking->car?->image_url
            ? url($this->booking->car->image_url)
            : url('/no-image.jpg');

        return (new MailMessage)
            ->subject('Your booking invoice - '.$this->booking->booking_number)
            ->view('emails.storefront.booking-invoice', [
                'booking' => $this->booking,
                'notifiable' => $notifiable,
                'carImageUrl' => $carImageUrl,
            ]);
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
