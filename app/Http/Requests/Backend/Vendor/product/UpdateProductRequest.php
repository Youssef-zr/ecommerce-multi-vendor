<?php

namespace App\Http\Requests\Backend\vendor\product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
                "thumb_image"=>"sometimes|nullable|image|mimes:png,jpg,jpeg,webp|max:2048",
                "name"=>"required|max:200|unique:products,name,".request()->product,
                "category_id"=>"required",
                "sub_category_id"=>"sometimes|nullable",
                "child_category_id"=>"sometimes|nullable",
                "brand"=>"sometimes|nullable",
                "sku"=>"sometimes|nullable",
                "price"=>"required|min:1",
                "offer_price"=>"sometimes|nullable",
                "offer_start_date"=>"sometimes|nullable|date|before:offer_end_date",
                "offer_end_date"=>"sometimes|nullable|date|after:offer_start_date",
                "qty"=>"required",
                "video_link"=>"sometimes|nullable|url",
                "short_description"=>"required|max:600",
                "long_description"=>"required",
                "product_type"=>"sometimes|nullable|in:new_arrival,top,best,feature,flash_deal,undefined",
                "seo_title"=>"sometimes|nullable|max:600",
                "seo_description"=>"sometimes|nullable",
                'status'=>'sometimes|nullable|in:active,inactive',
                'is_approved'=>'sometimes|nullable|in:pending,publish,removed',
            ];
    }
}
