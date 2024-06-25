<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paypal\UpdatePaypalRequest;
use App\Models\PaypalSetting;

class PaypalSettingController extends Controller
{
    public function update(UpdatePaypalRequest $request)
    {
        $data = $request->validated();
        PaypalSetting::updateOrCreate(['id' => 1], $data);

        toastr('Paypal setting updated successfully!', 'success', 'Success');
        return redirect()->back();
    }
}
