<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorewordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'language_code' => 'required|string|exists:languages,code',
            'word' => 'required|string|max:255',
            'translations' => 'sometimes|array',
            'translations.*.language_code' => 'required_with:translations|string|exists:languages,code',
            'translations.*.translation' => 'required_with:translations|string|max:255',
        ];
    }
}
