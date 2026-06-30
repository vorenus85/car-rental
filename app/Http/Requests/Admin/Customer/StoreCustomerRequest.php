<?php

namespace App\Http\Requests\Admin\Customer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{

    // Password validation is intentionally omitted.
    // Customer accounts are created without a password, and a password setup email
    // is sent immediately after creation. This allows customers to securely set
    // their own password instead of receiving a temporary one.

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('customers', 'email'),
            ],
        ];
    }
}
