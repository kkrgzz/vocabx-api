<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'language_code' => 'sometimes|string|exists:languages,code',
            'word' => 'sometimes|string|max:255',
            'translations' => 'sometimes|array',
            'translations.*.language_code' => 'required_with:translations|string|exists:languages,code',
            'translations.*.translation' => 'required_with:translations|string|max:255',
        ];
    }
}
