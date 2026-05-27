<?php

namespace App\Http\Requests\Account;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = auth()->user();

        return [
            'name' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ];
    }
}
