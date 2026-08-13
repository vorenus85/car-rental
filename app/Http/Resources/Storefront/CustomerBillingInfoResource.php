<?php

namespace App\Http\Resources\Storefront;

use App\Models\Booking\CustomerBillingInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CustomerBillingInfo
 */
class CustomerBillingInfoResource extends JsonResource
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
            'customerId' => $this->customer_id,
            'name' => $this->name,
            'country' => $this->country,
            'postcode' => $this->postcode,
            'city' => $this->city,
            'address' => $this->address,
            'companyName' => $this->company_name,
            'taxNumber' => $this->tax_number,
            'euVatNumber' => $this->eu_vat_number,
            'updatedAt' => $this->updated_at,
        ];
    }
}
