<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'model_id',
        'licence_plate',
        'image',
        'price_per_day',
        'body_type',
        'transmission',
        'fuel',
        'status',
        'production_year',
        'top_speed',
        'acceleration',
        'range',
        'description',
    ];

    protected $casts = [
        'acceleration' => 'float',
    ];
}
