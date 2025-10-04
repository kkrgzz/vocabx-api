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
            'sentence'                => 'sometimes|string|max:1000',
            'is_tatoeba_imported'     => 'sometimes|boolean',
            'tatoeba_id'              => 'sometimes|integer|nullable',
            'is_ai_generated'         => 'sometimes|boolean',
            'ai_review'               => 'sometimes|string|nullable',
            'ai_elapsed_time'         => 'sometimes|numeric|nullable',
            'ai_prompt_tokens'        => 'sometimes|integer|nullable',
            'ai_completion_tokens'    => 'sometimes|integer|nullable',
            'sentences'               => 'sometimes|array',
            'sentences.*.id'          => 'required_with:sentences|exists:sentences,id',
            'sentences.*.sentence'    => 'required_with:sentences|string|max:1000',
            'sentences.*.is_tatoeba_imported' => 'sometimes|boolean',
            'sentences.*.tatoeba_id'  => 'sometimes|integer|nullable',
            'sentences.*.is_ai_generated'      => 'sometimes|boolean',
            'sentences.*.ai_review'   => 'sometimes|string|nullable',
            'sentences.*.ai_elapsed_time'      => 'sometimes|numeric|nullable',
            'sentences.*.ai_prompt_tokens'     => 'sometimes|integer|nullable',
            'sentences.*.ai_completion_tokens' => 'sometimes|integer|nullable',
        ];
    }
}
