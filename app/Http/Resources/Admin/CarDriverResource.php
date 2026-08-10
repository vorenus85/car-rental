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
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'phone' => $this->phone,
            'birthDate' => $this->birthDate,

            'licenceNumber' => $this->licenceNumber,
            'licenceCountry' => $this->licenceCountry,
            'licenceIssueDate' => $this->licenceIssueDate,
            'licenceExpiryDate' => $this->licenceExpiryDate,
            'updatedAt' => $this->updated_at,
        ];
    }
}
