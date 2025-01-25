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
            'sentence' => 'required_without:sentences|string|max:1000',
            'sentences' => 'sometimes|array',
            'sentences.*.id' => 'required_with:sentences|exists:sentences,id',
            'sentences.*.sentence' => 'required_with:sentences|string|max:1000'
        ];
    }
}
