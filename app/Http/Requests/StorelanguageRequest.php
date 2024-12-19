<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorelanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'required|string|max:2|unique:languages,code',
            'name' => 'required|string|max:255|unique:languages,name'
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Language code is required',
            'code.max' => 'Language code must be 2 characters',
            'code.unique' => 'This language code already exists',
            'name.required' => 'Language name is required',
            'name.unique' => 'This language name already exists'
        ];
    }
}
