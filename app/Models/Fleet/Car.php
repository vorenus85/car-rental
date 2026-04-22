<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'variant_id',
        'licence_plate',
        'image',
        'price_per_day',
        'status',
        'production_year',
        'mileage',
        'color',
        'description',
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }
}
