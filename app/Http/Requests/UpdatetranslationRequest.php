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
            'word_id' => 'sometimes|exists:words,id',
            'language_code' => 'sometimes|exists:languages,code',
            'translation' => 'sometimes|string|max:255'
        ];
    }
}
