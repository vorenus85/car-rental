<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // @phpstan-ignore property.notFound
            'id' => $this->id,
            // @phpstan-ignore property.notFound
            'licence_plate' => $this->licence_plate,
            // @phpstan-ignore property.notFound
            'price_per_day' => $this->price_per_day,
            // @phpstan-ignore property.notFound
            'status' => $this->status,
            // @phpstan-ignore property.notFound
            'production_year' => $this->production_year,
            // @phpstan-ignore property.notFound
            'updated_at' => $this->updated_at,
            // @phpstan-ignore property.notFound
            'mileage' => $this->mileage,
            'image' => $this->whenHas('image'),
            'image_url' => $this->whenHas('image', function () {
                // @phpstan-ignore property.notFound
                return $this->image
                    ? Storage::url('/uploads/' . $this->image)
                    : null;
            }),
            'variant' => $this->whenLoaded('variant', function () {
                return [
                    // @phpstan-ignore property.notFound
                    'id' => $this->variant->id,
                    // @phpstan-ignore property.notFound
                    'name' => $this->variant->name,
                    // @phpstan-ignore property.notFound
                    'model' => $this->variant->relationLoaded('model') ? [
                        // @phpstan-ignore property.notFound
                        'id' => $this->variant->model->id,
                        // @phpstan-ignore property.notFound
                        'name' => $this->variant->model->name,
                        'brand' => $this->variant->model->relationLoaded('brand') ? [
                            // @phpstan-ignore property.notFound
                            'id' => $this->variant->model->brand->id,
                            // @phpstan-ignore property.notFound
                            'name' => $this->variant->model->brand->name,
                        ] : null,

                    ] : null,
                ];
            }),
        ];
    }
}
