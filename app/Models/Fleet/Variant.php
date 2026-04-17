<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
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
