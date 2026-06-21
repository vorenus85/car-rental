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
            'pricePerDay' => $this->price_per_day,
            'bodyType' => $this->variant?->body_type,
            'productionYear' => $this->production_year,
            'description' => $this->description,
            'mileage' => $this->mileage,
            'image' => $this->whenHas('image'),
            'imageUrl' => $this->image_url,
            'category' => $this->variant?->category,
            'seats' => $this->variant?->seats,
            'doors' => $this->variant?->doors,
            'transmission' => $this->variant?->transmission,
            'fuel' => $this->variant?->fuel,
            'rangeKm' => $this->variant?->range_km,
            'luggageCount' => $this->variant?->luggage_count,
            'name' => $this->variant?->model?->brand?->name . ' ' . $this->variant?->model?->name,
            'variantName' => $this->variant?->name,
            'variantDesc' => $this->variant?->description,
            'modelName' => $this->variant?->model?->name,
            'brandName' => $this->variant?->model?->brand?->name,
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
