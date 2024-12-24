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
            'word_id' => 'required_without:sentences|exists:words,id',
            'sentence' => 'required_without:sentences|string|max:1000',
            'sentences' => 'sometimes|array',
            'sentences.*.word_id' => 'required_with:sentences|exists:words,id',
            'sentences.*.sentence' => 'required_with:sentences|string|max:1000',
        ];
    }
}
