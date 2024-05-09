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
        return $currencyIcon??'$';
    }
}
