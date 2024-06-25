<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Adress\StoreUserAdressRequest;
use App\Http\Requests\Frontend\Checkout\CompleteShippingOrderRequest;
use App\Models\Backend\ShippingRule;
use App\Models\Backend\UserAdress;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    public function index()
    {
        $userAdress = UserAdress::get();
        $shippingRules = ShippingRule::where('status', 'active')->get();
        return view('frontend.pages.check-out', compact('userAdress', 'shippingRules'));
    }

    public function addAdress(StoreUserAdressRequest $request)
    {

        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        UserAdress::create($data);

        toastr('Adress Created Successfully!', 'success', 'Success');
        return to_route('user.checkout.index');
    }

    public function checkoutFormSubmit(CompleteShippingOrderRequest $request)
    {
        $shippingMethod = ShippingRule::findOrFail($request->get('shipping-method'));
        if ($shippingMethod) {
            Session::put('shipping_method', $shippingMethod);
        }

        $shippingAdress = UserAdress::findOrFail($request->get('shipping-adress'));
        if ($shippingAdress) {
            Session::put('shipping_adress', $shippingAdress);
        }

        return response()->json(['status' => 'success', 'redirect_to' => route('user.payment')], 200);
    }
}
