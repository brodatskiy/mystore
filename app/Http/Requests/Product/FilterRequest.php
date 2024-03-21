<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'string',
            'color' => 'string',
            'min_price' => 'integer',
            'max_price' => 'integer',
            'category_id' => 'integer|exists:categories,id',
            'tags' => 'array',
            'sizes' => 'array',
        ];
    }

    public function messages()
    {
        return [];
    }
}
