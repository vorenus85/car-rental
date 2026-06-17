<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * @return HasMany<Location, $this>
     */
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
