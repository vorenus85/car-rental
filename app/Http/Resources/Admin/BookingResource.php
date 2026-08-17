<?php

namespace App\Http\Resources\Admin;

use App\Models\Booking\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Booking
 */
class BookingResource extends JsonResource
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
            'bookingNumber' => $this->booking_number,
            'publicId' => $this->public_id,

            'status' => $this->status?->value,
            'statusLabel' => $this->status?->label(),

            'paymentStatus' => $this->payment_status?->value,
            'paymentStatusLabel' => $this->payment_status?->label(),
            'paymentMethod' => $this->payment_method,

            'pickupAt' => $this->pickup_at,
            'dropoffAt' => $this->dropoff_at,
            'days' => $this->days,

            'customer' => $this->whenLoaded('customer', function () {
                return [
                    'id' => $this->customer->id,
                    'firstName' => $this->customer->first_name,
                    'lastName' => $this->customer->last_name,
                    'email' => $this->customer->email,
                ];
            }),

            'driver' => $this->whenLoaded('driver', function () {
                return [
                    'id' => $this->driver->id,
                    'firstName' => $this->driver->first_name,
                    'lastName' => $this->driver->last_name,
                    'phone' => $this->driver->phone,
                ];
            }),

            'car' => $this->whenLoaded('car', function () {
                return [
                    'id' => $this->car->id,
                    'licencePlate' => $this->car->licence_plate,
                    'name' => implode(' ', array_filter([
                        $this->car?->variant?->model?->brand?->name,
                        $this->car?->variant?->model?->name,
                    ])),
                    'variantName' => $this->car?->variant?->name,
                ];
            }),

            'pickupLocation' => $this->whenLoaded('pickupLocation', function () {
                return [
                    'id' => $this->pickupLocation->id,
                    'name' => $this->pickupLocation->name,
                    'city' => $this->pickupLocation->city,
                ];
            }),

            'dropoffLocation' => $this->whenLoaded('dropoffLocation', function () {
                return [
                    'id' => $this->dropoffLocation->id,
                    'name' => $this->dropoffLocation->name,
                    'city' => $this->dropoffLocation->city,
                ];
            }),

            'insurance' => $this->whenLoaded('insurance', function () {
                return [
                    'id' => $this->insurance->id,
                    'name' => $this->insurance->name,
                    'price' => $this->insurance->price,
                ];
            }),

            'insuranceName' => $this->insurance_name,
            'insurancePrice' => $this->insurance_price,
            'insuranceTotal' => $this->insurance_total,

            'currency' => $this->currency,
            'dailyRate' => $this->daily_rate,
            'subtotal' => $this->subtotal,
            'extrasTotal' => $this->extras_total,
            'taxTotal' => $this->tax_total,
            'depositAmount' => $this->deposit_amount,
            'totalAmount' => $this->total_amount,

            'paidAt' => $this->paid_at,
            'confirmedAt' => $this->confirmed_at,
            'cancelledAt' => $this->cancelled_at,
            'completedAt' => $this->completed_at,

            'notes' => $this->notes,

            'extras' => $this->whenLoaded('extras', function () {
                return $this->extras->map(fn ($extra) => [
                    'id' => $extra->id,
                    'extraId' => $extra->extra_id,
                    'name' => $extra->name,
                    'quantity' => $extra->quantity,
                    'unitPrice' => $extra->unit_price,
                    'totalPrice' => $extra->total_price,
                ]);
            }),

            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
