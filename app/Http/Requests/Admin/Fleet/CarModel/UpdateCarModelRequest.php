<?php

namespace App\Http\Requests\Admin\Fleet\CarModel;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCarModelRequest extends FormRequest
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
                Rule::unique('car_models', 'name')->ignore($this->carModel)
            ],
            'description' => 'nullable|string',
            'brand_id' => 'required|int',
        ];
    }
}
