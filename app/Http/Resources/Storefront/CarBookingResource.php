<?php

namespace App\Http\Resources\Storefront;

use App\Models\Fleet\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Car
 */
class CarBookingResource extends JsonResource
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
            'pricePerDay' => $this->price_per_day,
            'image' => $this->whenHas('image'),
            'imageUrl' => $this->image_url,
            'name' => $this->variant?->model?->brand?->name . ' ' . $this->variant?->model?->name,
            'variantName' => $this->variant?->name,
            'modelName' => $this->variant?->model?->name,
            'brandName' => $this->variant?->model?->brand?->name,
        ];
    }
}
