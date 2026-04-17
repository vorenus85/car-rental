<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarVariant extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'model_id',
        'category',
        'description',

        'body_type',
        'transmission',
        'fuel',

        'top_speed',
        'acceleration',
        'range',

        'seats',
        'doors',
    ];
}
