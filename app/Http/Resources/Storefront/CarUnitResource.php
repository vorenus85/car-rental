<?php

namespace App\Http\Resources\Storefront;

use App\Models\Fleet\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Car
 */
class CarUnitResource extends JsonResource
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
            'body_type' => $this->variant?->body_type,
            'production_year' => $this->production_year,
            'description' => $this->description,
            'mileage' => $this->mileage,
            'image' => $this->whenHas('image'),
            'image_url' => $this->image_url,
            'category' => $this->variant?->category,
            'seats' => $this->variant?->seats,
            'doors' => $this->variant?->doors,
            'transmission' => $this->variant?->transmission,
            'fuel' => $this->variant?->fuel,
            'range_km' => $this->variant?->range_km,
            'luggage_count' => $this->variant?->luggage_count,
            'name' => $this->variant?->model?->brand?->name . ' ' . $this->variant?->model?->name,
            'variant_name' => $this->variant?->name,
            'variant_desc' => $this->variant?->description,
            'model_name' => $this->variant?->model?->name,
            'brand_name' => $this->variant?->model?->brand?->name,
            'features' => $this->whenLoaded('features', function () {
                return $this->features->map(function ($feature) {
                    return [
                        'id' => $feature->id,
                        'name' => $feature->name,
                    ];
                });
            }),
        ];
    }
}
