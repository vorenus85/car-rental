<?php

namespace App\Http\Requests\Admin\CarDriver;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCarDriverRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'birthDate' => ['required', 'date_format:Y-m-d'],
            'licenceNumber' => ['required', 'string', 'max:255'],
            'licenceCountry' => ['required', 'string', 'size:2'],
            'licenceIssueDate' => ['required', 'date_format:Y-m-d'],
            'licenceExpiryDate' => ['required', 'date_format:Y-m-d', 'after_or_equal:licenceIssueDate'],
        ];
    }
}
