<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoresentenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'word_id' => 'required|exists:words,id',
            'sentence' => 'required|string|max:1000'
        ];
    }
}
