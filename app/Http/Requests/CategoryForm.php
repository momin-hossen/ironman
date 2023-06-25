<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FindOutNumberRule;

class CategoryForm extends FormRequest
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

            'category_name' => ['required','unique:categories,category_name', new FindOutNumberRule],
            'category_description' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'category_name.required' => 'Category name kothay?',
            'category_description.required' => 'Description nai?'
        ];
    }
}
