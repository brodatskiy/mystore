<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required',
            'content' => 'required',
            'preview_image' => 'nullable|image',
            'color' => 'required|string',
            'price' => 'required|integer',
            'count' => 'required|integer',
            'is_published' => 'bool',
            'group_id' => 'integer|exists:groups,id',
            'category_id' => 'required|integer',
            'tags' => 'nullable|array',
        ];
    }

    public function messages()
    {
        return [
            'preview_image.image' => 'Must be an image',
        ];
    }
}
