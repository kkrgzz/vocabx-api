<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSentenceRequest extends FormRequest
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
            'sentence' => 'required_without:sentences|string|max:1000',
            'sentences' => 'sometimes|array',
            'sentences.*.id' => 'required_with:sentences|exists:sentences,id',
            'sentences.*.sentence' => 'required_with:sentences|string|max:1000'
        ];
    }
}
