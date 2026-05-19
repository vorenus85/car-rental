<?php

namespace App\Http\Resources;

use App\Models\Fleet\CarModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CarModel
 */
class CarModelResource extends JsonResource
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
            'updated_at' => $this->updated_at,
            'brand' => new BrandResource($this->whenLoaded('brand')),
        ];
    }
}
