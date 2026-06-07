<?php


namespace App\Http\Resources;

use App\Models\Fleet\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin Brand
 */
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
            'id' => $this->id,
            'name' => $this->name,
            'updated_at' => $this->updated_at,
            'image' => $this->whenHas('image'),
            'image_url' => $this->whenHas('image', function () {
                return $this->image
                    ? Storage::url('/uploads/' . $this->image)
                    : null;
            }),
        ];
    }
}
