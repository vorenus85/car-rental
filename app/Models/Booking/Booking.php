<?php

namespace App\Models\Booking;

use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use App\Enums\PaymentMethod;
use App\Models\Fleet\Car;
use App\Models\Fleet\Location;
use Database\Factories\Booking\BookingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property BookingStatus $status
 * @property PaymentStatus $payment_status
 * @property PaymentMethod $payment_method
 */
class Booking extends Model
{
    /** @use HasFactory<BookingFactory> */
    use HasFactory;

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
        'driver_id',

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
            'payment_method' => PaymentMethod::class,

            'pickup_at' => 'datetime',
            'dropoff_at' => 'datetime',

            'paid_at' => 'datetime',
            'confirmed_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'completed_at' => 'datetime',

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
     * @return BelongsTo<CarDriver, $this>
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(CarDriver::class);
    }

    /**
     * @return BelongsTo<Insurance, $this>
     */
    public function insurance(): BelongsTo
    {
        return $this->belongsTo(Insurance::class);
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
