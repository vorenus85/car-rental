<?php

namespace App\Notifications\Storefront;

use App\Models\Booking\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingInvoiceNotificationAdmin extends Notification
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
        return (new MailMessage)
            ->subject('New storefront booking - ' . $this->booking->booking_number)
            ->markdown('emails.branded-notification', [
                'logoUrl' => url('/images/logo.png'),
            ])
            ->greeting('New storefront booking created')
            ->line('Booking number: ' . $this->booking->booking_number)
            ->line('Pickup at: ' . $this->formatDate($this->booking->pickup_at))
            ->line('Dropoff at: ' . $this->formatDate($this->booking->dropoff_at))
            ->line('Pickup location: ' . $this->formatLocation($this->booking->pickupLocation))
            ->line('Dropoff location: ' . $this->formatLocation($this->booking->dropoffLocation))
            ->line('Customer name: ' . $this->formatCustomerName())
            ->line('Customer email: ' . ($this->booking->customer?->email ?: 'Not provided'))
            ->line('Total amount: ' . $this->formatAmount())
            ->line('Payment method: ' . $this->formatPaymentMethod())
            ->line('Days: ' . $this->booking->days)
            ->line('Notes: ' . ($this->booking->notes ?: 'Not provided'))
            ->line('Car name: ' . $this->formatCarName());
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

    private function formatDate(mixed $date): string
    {
        return $date
            ? $date->setTimezone('Europe/Budapest')->format('Y-m-d H:i')
            : 'Not provided';
    }

    private function formatLocation(mixed $location): string
    {
        if (! $location) {
            return 'Not provided';
        }

        return trim(implode(', ', array_filter([
            $location->name,
            $location->city,
        ]))) ?: 'Not provided';
    }

    private function formatCustomerName(): string
    {
        return trim(implode(' ', array_filter([
            $this->booking->customer?->first_name,
            $this->booking->customer?->last_name,
        ]))) ?: 'Not provided';
    }

    private function formatAmount(): string
    {
        return number_format((float) $this->booking->total_amount, 2) . ' ' . $this->booking->currency;
    }

    private function formatPaymentMethod(): string
    {
        $paymentMethod = $this->booking->payment_method;

        if ($paymentMethod->label()) {
            return $paymentMethod->label();
        }

        return 'Not provided';
    }

    private function formatCarName(): string
    {
        return trim(implode(' ', array_filter([
            $this->booking->car?->variant?->model?->brand?->name,
            $this->booking->car?->variant?->model?->name,
            $this->booking->car?->variant?->name,
        ]))) ?: 'Not provided';
    }
}
