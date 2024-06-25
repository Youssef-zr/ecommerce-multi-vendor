<?php

namespace App\Http\Requests\Paypal;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaypalRequest extends FormRequest
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
            "status" => "required|string|in:active,inactive",
            "account_mode" => "required|string|in:sandbox,live",
            "country_name" => "required|string|max:255",
            "currency_name" => "required|string",
            "currency_rate" => "required|numeric",
            "sandbox_client_id" => "required|string|max:255",
            "sandbox_secret_key" => "required|string|max:255",
            "live_client_id" => "required|string|max:255",
            "live_secret_key" => "required|string|max:255",
        ];
    }
}
