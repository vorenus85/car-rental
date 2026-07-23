<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Extra extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'icon',
        'maxQuantity'
    ];

    public function bookings(): BelongsToMany
    {
        return $this->belongsToMany(Booking::class);
    }
}
