<?php

namespace App\Http\Requests\Backend\Sliders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'banner' => "sometimes|nullable|image|max:2048|mimes:png,jpg,webp,jpeg",
            'type' => 'sometimes|nullable|max:200',
            'title' => 'required|max:200',
            'starting_price' => 'required|numeric|max:200',
            'btn_url' => 'url',
            'serial' => 'required|numeric|unique:sliders,serial,' . request()->slider->id,
            'status' => 'required|in:active,inactive'
        ];
    }
}
