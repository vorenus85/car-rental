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
        'email',
        'phone',
        'birth_date',
        'country',
        'city',
        'postal_code',
        'address_line_1',
        'address_line_2',
        'licence_number',
        'licence_country',
        'licence_issue_date',
        'licence_expiry_date'
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
