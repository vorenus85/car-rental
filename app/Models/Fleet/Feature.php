<?php

namespace App\Models\Fleet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
    ];

    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(Variant::class);
    }
}
