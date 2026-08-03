<?php

namespace App\Enums;

enum PaymentType: string
{
    case Stripe = 'stripe';
    case PayPal = 'paypal';
    case Cash = 'cash';

    public function label(): string
    {
        return match ($this) {
            self::Stripe => 'Stripe',
            self::PayPal => 'PayPal',
            self::Cash => 'Cash',
        };
    }
}
