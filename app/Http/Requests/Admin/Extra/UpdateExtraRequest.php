<?php

namespace App\Http\Requests\Admin\Extra;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExtraRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('extras', 'name')->ignore($this->extra)],
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
