<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = [
        'booking_number',
        'public_id',

        'customer_id',
        'car_id',

        'pickup_location_id',
        'dropoff_location_id',

        'pickup_at',
        'dropoff_at',

        'days',

        // Driver
        'driver_first_name',
        'driver_last_name',
        'driver_email',
        'driver_phone',
        'driver_birth_date',

        'driver_country',
        'driver_city',
        'driver_postal_code',
        'driver_address_line_1',
        'driver_address_line_2',

        'driver_licence_number',
        'driver_licence_country',
        'driver_licence_issue_date',
        'driver_licence_expiry_date',

        // Pricing
        'currency',
        'daily_rate',
        'subtotal',
        'extras_total',
        'insurance_id',
        'insurance_name',
        'insurance_price',
        'insurance_total',
        'tax_total',
        'deposit_amount',
        'total_amount',

        // Payment
        // External payment provider's payment intent identifier (e.g. Stripe)
        'payment_intent_id',
        'payment_method',
        'payment_status',
        'paid_at',

        // Booking
        'status',
        'notes',

        'confirmed_at',
        'cancelled_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => BookingStatus::class,
            'payment_status' => PaymentStatus::class,

            'pickup_at' => 'datetime',
            'dropoff_at' => 'datetime',

            'paid_at' => 'datetime',
            'confirmed_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'completed_at' => 'datetime',

            'driver_birth_date' => 'date',
            'driver_licence_issue_date' => 'date',
            'driver_licence_expiry_date' => 'date',

            'daily_rate' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'extras_total' => 'decimal:2',
            'insurance_price' => 'decimal:2',

            'insurance_total' => 'decimal:2',
            'tax_total' => 'decimal:2',
            'deposit_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return BelongsTo<Customer, $this>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo<Car, $this>
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * @return BelongsTo<Location, $this>
     */
    public function pickupLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    /**
     * @return BelongsTo<Location, $this>
     */
    public function dropoffLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'dropoff_location_id');
    }

    /**
     * @return HasMany<BookingExtra, $this>
     */
    public function extras(): HasMany
    {
        return $this->hasMany(BookingExtra::class);
    }
}
