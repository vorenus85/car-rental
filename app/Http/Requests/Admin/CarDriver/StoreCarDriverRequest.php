<?php

namespace App\Http\Requests\Admin\CarDriver;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'phone' => ['required', 'string', 'max:50'],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'licence_number' => ['required', 'string', 'max:255'],
            'licence_country' => ['required', 'string', 'size:2'],
            'licence_issue_date' => ['required', 'date_format:Y-m-d'],
            'licence_expiry_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:licence_issue_date'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'birth_date' => $this->birthDate,
            'licence_number' => $this->licenceNumber,
            'licence_country' => $this->licenceCountry,
            'licence_issue_date' => $this->licenceIssueDate,
            'licence_expiry_date' => $this->licenceExpiryDate,
        ]);
    }
}
