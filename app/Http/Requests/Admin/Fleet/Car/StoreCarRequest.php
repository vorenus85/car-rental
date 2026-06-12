<?php

namespace App\Http\Requests\Admin\Fleet\Car;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'variant_id' => ['required', 'exists:variants,id'],

            'location_id' => ['required', 'exists:locations,id'],

            'licence_plate' => [
                'required',
                'string',
                'max:255',
                'unique:cars,licence_plate',
            ],

            'price_per_day' => [
                'required',
                'numeric',
                'min:0',
            ],

            'status' => [
                'required',
                'in:available,reserved,rented,maintenance,inactive',
            ],

            'color' => [
                'required',
                'in:white,black,silver,gray,red,blue,green,yellow,orange,brown',
            ],

            'production_year' => [
                'required',
                'integer',
                'min:1900',
                'max:' . (date('Y') + 1),
            ],

            'mileage' => [
                'required',
                'integer',
                'min:0',
            ],

            'image' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'features' => ['nullable', 'array'],
            'features.*' => ['exists:features,id'],
        ];
    }
}
