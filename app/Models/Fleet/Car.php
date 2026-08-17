<?php

namespace App\Models\Fleet;

use App\Enums\CarStatus;
use Database\Factories\Fleet\CarFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Car extends Model
{
    //
    /** @use HasFactory<CarFactory> */
    use HasFactory;

    protected $fillable = [
        'variant_id',
        'location_id',
        'licence_plate',
        'image',
        'price_per_day',
        'status',
        'production_year',
        'mileage',
        'color',
        'description',
    ];

    protected $appends = [
        'image_url',
    ];

    protected function casts(): array
    {
        return [
            'status' => CarStatus::class
        ];
    }

    /**
     * @return BelongsTo<Variant, $this>
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }

    /**
     * @return BelongsTo<Location, $this>
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsToMany<Feature, $this>
     */
    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image
            ? Storage::url('/uploads/' . $this->image)
            : null;
    }
}
