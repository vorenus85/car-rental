<?php

namespace App\Http\Requests\Fleet\Feature;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFeatureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('features', 'name')->ignore($this->feature),
            ],
            'category' => 'required|string',
            'description' => 'string',
        ];
    }
}
