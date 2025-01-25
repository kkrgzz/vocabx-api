<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatetranslationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
