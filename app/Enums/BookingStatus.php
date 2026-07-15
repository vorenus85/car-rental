<?php

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case PickedUp = 'picked_up';
    case Returned = 'returned';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Confirmed => 'Confirmed',
            self::PickedUp => 'Picked Up',
            self::Returned => 'Returned',
            self::Cancelled => 'Cancelled',
        };
    }
}
