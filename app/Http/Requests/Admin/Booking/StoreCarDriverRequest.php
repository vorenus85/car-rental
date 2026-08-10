<?php

namespace App\Http\Requests\Admin\Booking;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCarDriverRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('car_drivers', 'email'),
            ],
            'phone' => ['required', 'string', 'max:50'],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'country' => ['required', 'string', 'size:2'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'licence_number' => ['required', 'string', 'max:255'],
            'licence_country' => ['required', 'string', 'size:2'],
            'licence_issue_date' => ['required', 'date_format:Y-m-d'],
            'licence_expiry_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:licence_issue_date'],
        ];
    }
}
