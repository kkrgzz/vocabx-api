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
            'sentence'                => 'required_without:sentences|string|max:1000',
            'is_ai_generated'         => 'sometimes|boolean',
            'ai_review'               => 'sometimes|string',
            'ai_elapsed_time'         => 'sometimes|numeric',
            'ai_prompt_tokens'        => 'sometimes|integer',
            'ai_completion_tokens'    => 'sometimes|integer',
            'sentences'               => 'sometimes|array',
            'sentences.*.id'          => 'required_with:sentences|exists:sentences,id',
            'sentences.*.sentence'    => 'required_with:sentences|string|max:1000',
            'sentences.*.is_ai_generated'      => 'sometimes|boolean',
            'sentences.*.ai_review'   => 'sometimes|string',
            'sentences.*.ai_elapsed_time'      => 'sometimes|numeric',
            'sentences.*.ai_prompt_tokens'     => 'sometimes|integer',
            'sentences.*.ai_completion_tokens' => 'sometimes|integer',
        ];
    }
}
