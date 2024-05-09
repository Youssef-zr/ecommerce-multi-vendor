<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\FlashSale;
use App\Models\Backend\FlashSaleItem;
use App\Models\Backend\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::whereStatus('active')
            ->orderBy('serial', 'desc')->get();

        $flashSale = FlashSale::first();
        
        $flashSaleItems = FlashSaleItem::with('product.mainCategory')
            ->where('status', 'active')->where('show_at_home', 'yes')
            ->get();

        return view(
            'frontend.home.home',
            compact('sliders', 'flashSale', 'flashSaleItems')
        );
    }
}
