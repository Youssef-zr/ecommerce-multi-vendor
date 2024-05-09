<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralSettingRequest extends FormRequest
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
            "site_name" => 'required|max:255',
            "layout" => 'required|in:RTL,LTR',
            "contact_email" => 'required|email',
            "currency_name" => 'required|max:255',
            "time_zone" => 'required|max:255',
        ];
    }
}
