<?php

namespace App\Http\Resources\Storefront;

use App\Models\Fleet\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Car
 */
class CarCardResource extends JsonResource
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
            'price_per_day' => $this->price_per_day,
            'production_year' => $this->production_year,
            'image' => $this->whenHas('image'),
            'image_url' => $this->image_url,
            'category' => $this->variant?->category,
            'seats' => $this->variant?->seats,
            'transmission' => $this->variant?->transmission,
            'fuel' => $this->variant?->fuel,
            'luggage_count' => $this->variant?->luggage_count,
            'name' => $this->variant?->model?->brand?->name . ' ' . $this->variant?->model?->name,
            'variant_name' => $this->variant?->name,
            'model_name' => $this->variant?->model?->name,
            'brand_name' => $this->variant?->model?->brand?->name,
        ];
    }
}
