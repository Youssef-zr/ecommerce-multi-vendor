<?php

namespace App\Http\Requests\Backend\Sliders;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
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
            'banner' => "required|image|max:2048|mimes:png,jpg,webp",
            'type' => 'sometimes|nullable|max:40',
            'title' => 'required|max:80',
            'starting_price' => 'required|numeric',
            'btn_url' => 'url',
            'serial'=>'required|numeric|unique:sliders,serial',
            'status'=>'required|in:active,inactive'
        ];
    }
}
