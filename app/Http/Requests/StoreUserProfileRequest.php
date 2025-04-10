<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserProfileRequest extends FormRequest
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
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mother_language' => 'nullable|string|max:255',
            'target_language' => 'nullable|string|max:255',
            'is_ai_assistant_enabled' => 'nullable|boolean',
            'api_key' => 'nullable|string|max:255',
            'preferred_model_id' => 'nullable|string|max:255',
        ];
    }
}