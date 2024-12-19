<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatesentenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'word_id' => 'sometimes|exists:words,id',
            'sentence' => 'sometimes|string|max:1000'
        ];
    }
}
