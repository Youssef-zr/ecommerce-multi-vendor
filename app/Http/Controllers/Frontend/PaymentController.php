<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function index()
    {
        if (!Session::has('shipping_adress')) {
            return to_route('user.checkout.index');
        }

        return view('frontend.pages.payment');
    }

    // payment success
    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    // paypal configuration
    public function paypalConfig()
    {
        $paypalSettings = PaypalSetting::first();

        $config = [
            'mode'    => $paypalSettings->account_mode,
            'sandbox' => [
                'client_id'         => $paypalSettings->sandbox_client_id,
                'client_secret'     =>  $paypalSettings->sandbox_secret_key,
            ],
            'live' => [
                'client_id'         => $paypalSettings->live_client_id,
                'client_secret'     =>  $paypalSettings->live_secret_key,
            ],

            'payment_action' => 'Sale',
            'currency'       => $paypalSettings->currency_name,
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];

        return $config;
    }

    // paypal redirect
    public function payWithPaypal()
    {
        $config = $this->paypalConfig();
        $paypalSetting = PaypalSetting::first();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();


        // calculate payable amount depending on currncey rate by usd
        $total = getFinalPayableAmount();
        $payableAmount = round($total * $paypalSetting->currency_rate);


        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $payableAmount
                    ],
                ],
            ]
        ]);

        if (isset($response['id']) and $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === "approve") {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('user.paypal.cancel');
        }
    }

    public function paypalSuccess(Request $request)
    {
        $config = $this->paypalConfig();
        
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = (object) $provider->capturePaymentOrder($request->token);

        if (isset($response->status) and $response->status == "COMPLETED") {
            return redirect()->route('user.payment.success');
        }

        return to_route('user.paypal.cancel');
    }

    public function paypalCancel()
    {
        toastr('Someting went wrong try again later!!', 'error', 'Error');
        return redirect()->route('user.payment');
    }
}
