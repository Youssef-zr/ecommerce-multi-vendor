<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\{
    FlashSale,
    FlashSaleItem
};

class FlashSaleController extends Controller
{
    public function index()
    {
        $flashSale = FlashSale::first();
        $flashSaleItems = FlashSaleItem::orderBy('id', 'desc')
            ->whereStatus('active')->paginate(20);

        return view(
            'frontend.pages.flash-sale',
            compact('flashSale', 'flashSaleItems')
        );
    }
}
