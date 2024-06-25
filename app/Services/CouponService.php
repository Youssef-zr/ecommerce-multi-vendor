<?php

namespace App\Services;

use App\Models\Backend\Coupon;
use Carbon\Carbon;

class CouponService
{
    public function applyCoupon($request)
    {
        $coupon_code = $request->coupon_code;

        if (empty($coupon_code)) {
            return $this->errorResponse('Coupon is required');
        }

        $coupon = Coupon::where(['status' => 'active', 'code' => $coupon_code])->first();

        if (empty($coupon)) {
            return $this->errorResponse('Coupon code not exist!');
        }

        if (getCartSubTotal() == 0) {
            return $this->errorResponse('Cart not has items!');
        }

        $validationMessage = $this->validateCoupon($coupon);

        if (!empty($validationMessage)) {
            return $this->errorResponse($validationMessage);
        }

        session()->put('coupon', [
            'coupon_name' => $coupon->name,
            'coupon_code' => $coupon->code,
            'discount_type' => $coupon->discount_type,
            'discount' => $coupon->discount
        ]);

        return response()->json(['status' => 'success', 'message' => 'Coupon applied successfully!'], 200);
    }

    private function errorResponse($message)
    {
        return response()->json(['status' => 'error', 'message' => $message], 400);
    }

    private function validateCoupon($coupon)
    {
        $startDate = Carbon::parse($coupon->start_date);
        $endDate = Carbon::parse($coupon->end_date);
        $now = Carbon::now();

        return $now->lt($startDate) ? 'The coupon code is not yet valid.'
            : ($now->gt($endDate) ? 'The coupon code is expired.'
                : ($coupon->total_used > $coupon->quantity ? 'You can not apply this coupon.'
                    : null));
    }
}
