<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
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
            'title'=>'required|string|max:64',
            'description'=>'sometimes|nullable|string|max:1024',
            'status'=>'required|string',
            'due_date'=>'sometimes|nullable|date',
            'category_id'=>'sometimes|nullable|integer|exists:todo_categories,id',
        ];
    }
}
