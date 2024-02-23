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
            'preview_image' => 'nullable|image',
            'color' => 'required|string',
            'price' => 'required|integer',
            'is_published' => 'bool',
            'group_id' => 'integer|exists:groups,id',
            'category_id' => 'required|integer',
            'tags' => 'nullable|array',
            'sizes.*.id' => 'required|integer',
            'sizes.*.count' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'preview_image.image' => 'Must be an image',
            'sizes.*.count.integer' => 'The field must be an integer',
            'sizes.*.count.required' => 'The field is required.',
        ];
    }
}
