<?php

namespace App\Enums;

enum CarStatus: string
{
    case Available = 'available';
    case Reserved = 'reserved';
    case Rented = 'rented';
    case Maintenance = 'maintenance';
    case Inactive = 'inactive';

    public function label(): string
    {
        return match ($this) {
            self::Available => 'Available',
            self::Reserved => 'Reserved',
            self::Rented => 'Rented',
            self::Maintenance => 'Maintenance',
            self::Inactive => 'Inactive',
        };
    }
}
