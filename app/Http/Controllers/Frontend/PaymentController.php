<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        if(!Session::has('shipping_adress')){
            return to_route('user.checkout.index');
        }

        return view('frontend.pages.payment');
    }
}
