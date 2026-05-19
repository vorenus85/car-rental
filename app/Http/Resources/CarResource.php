<?php

namespace App\Http\Resources;

use App\Models\Fleet\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin Car
 */
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
            'id' => $this->id,
            'licence_plate' => $this->licence_plate,
            'price_per_day' => $this->price_per_day,
            'status' => $this->status,
            'production_year' => $this->production_year,
            'updated_at' => $this->updated_at,
            'mileage' => $this->mileage,
            'image' => $this->whenHas('image'),
            'image_url' => $this->whenHas('image', function () {
                return $this->image
                    ? Storage::url('/uploads/' . $this->image)
                    : null;
            }),
            'variant' => $this->whenLoaded('variant', function () {
                return [
                    'id' => $this->variant->id,
                    'name' => $this->variant->name,
                    'model' => $this->variant->relationLoaded('model') ? [
                        'id' => $this->variant->model->id,
                        'name' => $this->variant->model->name,
                        'brand' => $this->variant->model->relationLoaded('brand') ? [
                            'id' => $this->variant->model->brand->id,
                            'name' => $this->variant->model->brand->name,
                        ] : null,

                    ] : null,
                ];
            }),
        ];
    }
}
