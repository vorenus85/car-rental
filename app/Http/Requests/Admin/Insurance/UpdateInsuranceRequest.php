<?php

namespace App\Http\Requests\Admin\Insurance;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInsuranceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('insurances', 'name')->ignore($this->insurance)],
            'description' => 'nullable|string',
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'recommended' => [
                'required',
                'boolean',
            ],
        ];
    }
}
