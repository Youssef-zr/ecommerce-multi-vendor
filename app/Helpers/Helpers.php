<?php

use Illuminate\Support\Facades\File;

/**
 * side bar active links
 */

if (!function_exists('setActive')) {
    function setActive(array $route)
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (request()->routeIs($r)) {
                    return 'active';
                }
            }
        }
    }
}

// make new directory to storage
if (!function_exists('makeDir')) {
    function makeDir($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path);
        }
    }
}

// remove directory from storage
if (!function_exists('removeDir')) {
    function removeDir($path)
    {

        if (File::exists($path) and File::isDirectory($path) and empty(File::files($path))) {
            File::deleteDirectory($path);
        }
    }
}


// check product has discrount
if (!function_exists('hasDiscount')) {
    function hasDiscount($product)
    {
        $currentDate = date('Y-m-d');

        if ($product->offer_price > 0 and $currentDate >= $product->offer_start_date and $currentDate <= $product->offer_end_date) {
            return true;
        }

        return false;
    }
}

// calculate price percentage discount
if (!function_exists('percentageDiscount')) {
    function percentageDiscount($regularPrice, $offerPrice)
    {
        $discountAmount = $regularPrice - $offerPrice;
        $discountPercentage = ($discountAmount / $regularPrice) * 100;

        return intval($discountPercentage);
    }
}

// product type
if (!function_exists('productType')) {
    function productType(string $type): string
    {
        $explodeType = explode('_', $type);
        return $explodeType[0];
    }
}

// get first image gallery for product
if (!function_exists('get2ndProductImage')) {
    function get2ndProductImage($product)
    {
        $gallary = $product->imageGallery;

        if ($gallary->count()) {
            return $gallary[0]->image;
        } else {
            return $product->thumb_image;
        }
    }
}

// get currency icon
if (!function_exists('getCurrencyIcon')) {
    function getCurrencyIcon($currencyCode)
    {
        $currencyIcon = config('settings.currency_symbol.' . $currencyCode);
        return $currencyIcon ?? '$';
    }
}


// calcualt cart subTotal
if (!function_exists('getCartSubTotal')) {
    function getCartSubTotal()
    {

        $total = 0;
        foreach (Cart::content() as $item) {
            $total += ($item->price + $item->options->variantTotalPrice) * $item->qty;
        }

        return $total;
    }
}



// get payable total amount
if (!function_exists('getMainCartTotal')) {
    function getMainCartTotal()
    {
        if (session()->has('coupon')) {
            $coupon = (object) session()->get("coupon");
            $subTotal = getCartSubTotal();

            if ($coupon->discount_type == 'amount') {
                $total = $subTotal - $coupon->discount;
                return $total;
            } else if ($coupon->discount_type == 'percent') {
                $discount = ($subTotal * $coupon->discount / 100);
                $total = $subTotal - $discount;
                return $total;
            }
        } else {
            return getCartSubTotal();
        }
    }
}

// get cart discount when apply coupon
if (!function_exists('getCartDiscount')) {
    function getCartDiscount()
    {
        if (session()->has('coupon')) {
            $coupon = (object) session()->get("coupon");
            $subTotal = getCartSubTotal();

            if ($coupon->discount_type == 'amount') {
                return $coupon->discount;
            } else if ($coupon->discount_type == 'percent') {
                $discount = ($subTotal * $coupon->discount / 100);
                return $discount;
            }
        } else {
            return 0;
        }
    }
}

// get shipping method (fee)
if (!function_exists('getShippingFee')) {
    function getShippingFee()
    {
        if(session()->has('shipping_method')){
            return session()->get('shipping_method')->cost;
        }

        return 0;
    }
}


// get payable amount (fee + mainAmount)
if (!function_exists('getFinalPayableAmount')) {
    function getFinalPayableAmount()
    {
        return getMainCartTotal()  + getShippingFee();
    }
}
