<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(CarModel::class);
    }
}
