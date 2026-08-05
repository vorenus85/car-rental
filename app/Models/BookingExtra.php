<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingExtra extends Model
{
    protected $fillable = [
        'booking_id',
        'extra_id',

        // Snapshot
        'name',
        'description',
        'quantity',
        'unit_price',
        'total_price',

    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',

            'unit_price' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return BelongsTo<Booking, $this>
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * @return BelongsTo<Extra, $this>
     */
    public function extra(): BelongsTo
    {
        return $this->belongsTo(Extra::class);
    }
}
