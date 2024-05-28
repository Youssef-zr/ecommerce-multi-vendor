<?php

namespace App\Http\Requests\Backend\ShippingRule;

use Illuminate\Foundation\Http\FormRequest;

class StoreShippingRuleRequest extends FormRequest
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
            'name' => 'required|unique:shipping_rules,name',
            'type' => 'required|string|in:flat_cost,min_cost',
            'min_cost' => 'sometimes|nullable|numeric',
            'cost' => 'required|numeric',
            'status' => 'required|string|in:active,inactive'
        ];
    }
}
