<?php

namespace App\Http\Resources\Admin;

use App\Models\Extra;
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
            'price' => $this->price,
            'icon' => $this->icon,
            'maxQuantity' => $this->maxQuantity,
            'description' => $this->description,
            'updatedAt' => $this->updated_at,
        ];
    }
}
