<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'city_id',
        'address',

        'latitude',
        'longitude',

        'type', // airport, railway_station, city_center, office, hotel, other

        'phone',
        'email',

        'business_hours',

        'image',
        'description',

        'active'
    ];

    protected $appends = [
        'city',
    ];

    protected $hidden = [
        'city_model',
    ];

    protected $casts = [
        'business_hours' => 'array',
        'active' => 'boolean',
    ];

    /**
     * Undocumented function
     *
     * @return HasMany<Car, $this>
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    /**
     * @return BelongsTo<City, $this>
     */
    public function cityModel(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function getCityAttribute(): ?string
    {
        return $this->cityModel?->name;
    }
}
