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
            'name' => $this->first_name.' '.$this->last_name,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'phone' => $this->phone,
            'birthDate' => $this->birth_date,

            'licenceNumber' => $this->licence_number,
            'licenceCountry' => $this->licence_country,
            'licenceIssueDate' => $this->licence_issue_date,
            'licenceExpiryDate' => $this->licence_expiry_date,
            'updatedAt' => $this->updated_at,
        ];
    }
}
