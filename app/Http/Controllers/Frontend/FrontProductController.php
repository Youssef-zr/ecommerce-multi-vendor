<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use Illuminate\Support\Facades\Cache;

class FrontProductController extends Controller
{
    // show frontend product details
    public function productDetail(string $slug)
    {

        // $product = Product::with(["imageGallery", 'brand', 'vendor', "variants" => function ($q) {
        //     $q->whereStatus('active')->with(['variantItems' => function ($q) {
        //         $q->whereStatus('active');
        //     }]);
        // }])->whereSlug($slug)->whereStatus('active')->first();

        $product =  Cache::remember('product_' . $slug, now()->addMinutes(60), function () use ($slug) {
            return Product::with([
                'imageGallery',
                'brand',
                'vendor',
                'variants.variantItems' => function ($query) {
                    $query->where('status', 'active')
                          ->with(['variantItems' => function ($q) {
                              $q->where('status', 'active');
                          }]);
                }
            ])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->first();
        });


        return view('frontend.pages.product-detail', compact('product'));
    }

}
