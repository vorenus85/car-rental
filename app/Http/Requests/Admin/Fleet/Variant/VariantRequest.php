<?php

namespace App\Http\Requests\Admin\Fleet\Variant;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VariantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'model_id' => ['required', 'integer', 'exists:car_models,id'],
            'category' => ['required', 'in:economy,compact,suv,business,premium'],
            'description' => ['nullable', 'string'],
            'body_type' => ['required', 'in:suv,sedan,hatchback,coupe,wagon'],
            'transmission' => ['required', 'in:manual,automatic'],
            'fuel' => ['required', 'in:petrol,diesel,electric,hybrid'],
            'seats' => ['required', 'integer', 'min:1', 'max:9'],
            'doors' => ['required', 'integer', 'min:1', 'max:5'],
            'luggage_count' => ['required', 'integer', 'min:1', 'max:5'],

            'range_km' => ['required', 'integer'],

            'features' => 'nullable|array',
            'features.*' => 'exists:features,id',
        ];
    }
}
