<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BrandResource extends JsonResource
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
            'name' => $this->name,
            // @phpstan-ignore property.notFound
            'image' => $this->image,
            // @phpstan-ignore property.notFound
            'image_url' => $this->image
                ? Storage::url('/uploads/'.$this->image)
                : null
        ];
    }
}
