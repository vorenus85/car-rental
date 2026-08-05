<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Database\Factories\Fleet\VariantFactory;

class Variant extends Model
{
    //
    /** @use HasFactory<VariantFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'model_id',
        'description',

        'body_type',
        'transmission',
        'fuel',

        'seats',
        'doors',
        'luggage_count',

        'range_km',
    ];

    /**
     * @return BelongsTo<CarModel, $this>
     */
    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    /**
     * @return HasMany<Car, $this>
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'variant_id', 'id');
    }
}
