<?php

namespace App\Http\Resources\Storefront;

use App\Models\Booking\Extra;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Extra
 */
class ExtraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'icon' => $this->icon,
            'price' => $this->price,
            'maxQuantity' => $this->maxQuantity,
        ];
    }
}
