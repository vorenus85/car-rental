<?php


namespace App\Http\Resources\Storefront;

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
            'value' => $this->id,
            'label' => $this->name,
        ];
    }
}
