<?php

namespace App\Models\Booking;

use Database\Factories\Booking\CarDriverFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDriver extends Model
{
    /** @use HasFactory<CarDriverFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'birth_date',
        'licence_number',
        'licence_country',
        'licence_issue_date',
        'licence_expiry_date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'licence_issue_date' => 'date',
            'licence_expiry_date' => 'date',
        ];
    }
}
