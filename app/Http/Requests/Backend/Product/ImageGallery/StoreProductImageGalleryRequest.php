<?php

namespace App\Http\Requests\Backend\Product\ImageGallery;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductImageGalleryRequest extends FormRequest
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
            'product_id'=>'required|numeric',
            'image.*'=>'required|image|mimes:png,jpg,jpeg,webp|max:2048'
        ];
    }
}
