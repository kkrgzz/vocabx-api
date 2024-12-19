<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatelanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'sometimes|string|max:2|unique:languages,code,' . $this->language->code . ',code',
            'name' => 'sometimes|string|max:255|unique:languages,name,' . $this->language->name . ',name'
        ];
    }
}
