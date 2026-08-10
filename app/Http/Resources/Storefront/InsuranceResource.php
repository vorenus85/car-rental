<?php

namespace App\Http\Resources\Storefront;

use App\Models\Booking\Insurance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Insurance
 */
class InsuranceResource extends JsonResource
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
            'recommended' => $this->recommended,
            'price' => $this->price,
        ];
    }
}
