<?php

namespace App\Http\Requests\Admin\Fleet\Location;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLocationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('locations', 'name')->ignore($this->location),],

            'country' => ['required', 'string', 'max:255'],
            'city_id' => ['required', Rule::exists('cities', 'id')],
            'address' => ['required', 'string', 'max:255'],

            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],

            'type' => [
                'required',
                'string',
                'in:airport,railway_station,city_center,office,hotel,other',
            ],

            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],

            'business_hours' => ['nullable', 'array'],

            'image' => ['nullable', 'string', 'max:255'],

            'description' => ['nullable', 'string'],

            'active' => ['required', 'boolean'],
        ];
    }
}
