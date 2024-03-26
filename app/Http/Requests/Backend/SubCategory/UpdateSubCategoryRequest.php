<?php

namespace App\Http\Requests\Backend\SubCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCategoryRequest extends FormRequest
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
        $id = request()->segments()[3];

        return [
            "category_id" => 'required',
            "name" => "required|min:3|max:200|unique:sub-categories,name," . $id,
            "status" => "required|in:active,inactive",
        ];
    }

    public function attributes()
    {

        return [
            'category_id' => 'main category'
        ];
    }
}
