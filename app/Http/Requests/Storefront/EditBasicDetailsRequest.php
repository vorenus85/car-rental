<?php

namespace App\Http\Requests\Storefront;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditBasicDetailsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $customerId = $this->user('customer')?->id;

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('customers', 'email')->ignore($customerId),
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
        ]);
    }
}
