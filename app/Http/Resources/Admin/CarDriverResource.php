<?php

namespace App\Http\Resources\Admin;

use App\Models\Booking\CarDriver;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CarDriver
 */
class CarDriverResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
            'country' => $this->country,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'licence_number' => $this->licence_number,
            'licence_country' => $this->licence_country,
            'licence_issue_date' => $this->licence_issue_date,
            'licence_expiry_date' => $this->licence_expiry_date,
            'updated_at' => $this->updated_at,
        ];
    }
}
