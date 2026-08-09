<?php

namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerBillingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:100'],
            'postcode' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],

            'company_name' => ['nullable', 'string', 'max:255'],
            'tax_number' => ['nullable', 'string', 'max:50'],
            'eu_vat_number' => ['nullable', 'string', 'max:50'],
        ];
    }
}
