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
        'firstName',
        'lastName',
        'phone',
        'birthDate',
        'licenceNumber',
        'licenceCountry',
        'licenceIssueDate',
        'licenceExpiryDate'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birthDate' => 'date',
            'licenceIssueDate' => 'date',
            'licenceExpiryDate' => 'date',
        ];
    }
}
