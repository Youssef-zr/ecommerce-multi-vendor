<?php

namespace App\Http\Requests\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            "name"=>'required|string|unique:coupons,name',
            "code"=>'required',
            "quantity"=>'required|numeric',
            "max_use"=>'required|numeric',
            "start_date"=>'required|date',
            "end_date"=>'required|date|after:start_date',
            "discount_type"=>'required|in:percent,amount',
            "discount"=>'required|numeric',
            "status"=>'required|in:active,inactive',
            "total_used"=>'required|numeric',
        ];
    }
}
