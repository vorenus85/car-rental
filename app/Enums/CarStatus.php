<?php

namespace App\Enums;

enum CarStatus: string
{
    case Available = 'available';
    case Maintenance = 'maintenance';
    case Inactive = 'inactive';

    public function label(): string
    {
        return match ($this) {
            self::Available => 'Available',
            self::Maintenance => 'Maintenance',
            self::Inactive => 'Inactive',
        };
    }
}
