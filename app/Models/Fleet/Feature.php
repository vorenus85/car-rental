<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Database\Factories\Fleet\FeatureFactory;

class Feature extends Model
{
    //
    /** @use HasFactory<FeatureFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
    ];

    /**
     * @return BelongsToMany<Car, $this>
     */
    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class);
    }
}
