<?php

namespace App\Http\Resources\Admin;

use App\Models\Booking\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Customer
 */
class CustomerResource extends JsonResource
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
            'name' => $this->first_name . " " . $this->last_name,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'active' => $this->active,
            'updatedAt' => $this->updated_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
