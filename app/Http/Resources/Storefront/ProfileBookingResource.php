<?php

namespace App\Http\Resources\Storefront;

use App\Models\Booking\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Booking
 */
class ProfileBookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'vehicle' => implode(' ', array_filter([
                $this->car?->variant?->model?->brand?->name,
                $this->car?->variant?->model?->name,
            ])),

            'vehicleImg' => $this->car?->image_url,

            'bookingNumber' => $this->booking_number,

            'customerEmail' => $this->customer?->email,

            'pickupAt' => $this->pickup_at,

            'dropoffAt' => $this->dropoff_at,

            'pickUpCity' => $this->pickupLocation?->city,

            'pickUpLocation' => $this->pickupLocation?->name,

            'dropOffCity' => $this->dropoffLocation?->city,

            'dropOffLocation' => $this->dropoffLocation?->name,

            'bookingTotal' => $this->total_amount,

            'days' => $this->days,

            'status' => $this->status,

            'driver' => $this->whenLoaded('driver', function () {
                return [
                    'name' => $this->driver->first_name.' '.$this->driver->last_name,
                    'phone' => $this->driver->phone,
                ];
            }),
        ];
    }
}
