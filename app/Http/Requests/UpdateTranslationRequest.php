<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTranslationRequest extends FormRequest
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
            'translations' => 'sometimes|array',
            'translations.*.word_id' => 'required_with:translations|exists:words,id',
            'translations.*.language_code' => 'required_with:translations|exists:languages,code',
            'translations.*.translation' => 'required_with:translations|string|max:255',
            'word_id' => 'required_without:translations|exists:words,id',
            'language_code' => 'required_without:translations|exists:languages,code',
            'translation' => 'required_without:translations|string|max:255',
        ];
    }
}
