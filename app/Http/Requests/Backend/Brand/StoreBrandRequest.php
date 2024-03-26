<?php

namespace App\Http\Requests\Backend\Brand;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'image' => 'required|image|max:2028|mimes:png,jpg,webp,jpeg',
            'name' => 'required|max:200|unique:brands,name',
            'status' => "required|in:active,inactive",
            'is_featured' => "required|in:active,inactive",
        ];
    }
}
