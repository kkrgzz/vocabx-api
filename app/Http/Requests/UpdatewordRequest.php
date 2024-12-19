<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatewordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'language_code' => 'sometimes|string|exists:languages,code',
            'word' => 'sometimes|string|max:255'
        ];
    }
}
