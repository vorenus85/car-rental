<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function variant()
    {
        return $this->belongsTo(\App\Models\Fleet\Variant::class);
    }
}
