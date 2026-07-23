<?php

namespace App\Http\Requests\Admin\Extra;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreExtraRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'icon' => [
                'nullable',
                'string',
            ],
            'maxQuantity' => [
                'required',
                'numeric',
                'min:1',
            ],
        ];
    }
}
