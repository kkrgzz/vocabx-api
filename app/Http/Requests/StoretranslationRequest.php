<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoretranslationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'word_id' => 'required|exists:words,id',
            'language_code' => 'required|exists:languages,code',
            'translation' => 'required|string|max:255'
        ];
    }
}
