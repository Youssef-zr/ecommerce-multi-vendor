<?php

namespace App\Http\Requests\Backend\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorRequest extends FormRequest
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
        $vendorId = auth()->user()->vendor->id;

        return [
            'name' => 'required|unique:vendors,name,' . $vendorId,
            'shop-name'=>"required|max:70|unique:vendors,shop-name,".$vendorId,
            'banner' => 'sometimes|nullable|image|max:2048|mimes:png,jpg,jpeg,webp',
            'email' => 'required|email|unique:vendors,email,' . $vendorId,
            'phone' => 'required|numeric|digits:10|unique:vendors,phone,' . $vendorId,
            'description' => 'required|max:300',
            'fb_link' => 'sometimes|nullable|url',
            'tw_link' => 'sometimes|nullable|url',
            'insta_link' => 'sometimes|nullable|url',
        ];
    }

    public function attributes(): array
    {
        return [
            'fb_link' => 'facebook',
            'tw_link' => 'twitter',
            'insta_link' => 'instagram',
        ];
    }
}
