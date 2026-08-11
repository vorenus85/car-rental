<?php

namespace App\Http\Requests\Storefront;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'carId' => ['required', 'integer', 'exists:cars,id'],
            'customerId' => ['required', 'integer', 'exists:customers,id'],
            'pickUpLocationId' => ['required', 'integer', 'exists:locations,id'],
            'dropOffLocationId' => ['required', 'integer', 'exists:locations,id'],

            'pickUpDate' => ['required', 'date_format:Y-m-d'],
            'dropOffDate' => ['required', 'date_format:Y-m-d'],

            'pickUpTime' => ['required', 'date_format:H:i'],
            'dropOffTime' => ['required', 'date_format:H:i'],

            'driver_first_name' => ['required', 'string'],
            'driver_last_name' => ['required', 'string'],
            'driver_phone' => ['required', 'string'],
            'driver_birth_date' => ['required', 'date_format:Y-m-d'],

            'driver_licence_number' => ['required', 'string'],
            'driver_licence_country' => ['required', 'string', 'size:2'],
            'driver_licence_issue_date' => ['required', 'date_format:Y-m-d'],
            'driver_licence_expiry_date' => ['required', 'date_format:Y-m-d'],

            'payment_method' => ['required', 'string', 'in:stripe,paypal,cash'],

            'insurance_id' => ['required', 'integer', 'exists:insurances,id'],

            'extras' => ['nullable', 'array'],
            'extras.*.id' => ['required', 'integer', 'exists:extras,id'],
            'extras.*.quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
