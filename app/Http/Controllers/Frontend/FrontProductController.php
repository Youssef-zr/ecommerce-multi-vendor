<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;

class FrontProductController extends Controller
{
    // show frontend product details
    public function productDetail(string $slug)
    {

        $product = Product::with(["imageGallery", 'brand', 'vendor', "variants" => function ($q) {
            $q->whereStatus('active')->with(['variantItems' => function ($q) {
                $q->whereStatus('active');
            }]);
        }])->whereSlug($slug)->whereStatus('active')->first();

        return view('frontend.pages.product-detail', compact('product'));
    }

}
