<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Settings\UpdateGeneralSettingRequest;
use App\Models\Backend\Setting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function index()
    {

        $generalSetting = Setting::first();
        return view('admin.setting.index', compact('generalSetting'));
    }

    // update general settings
    public function updateGeneralSetting(UpdateGeneralSettingRequest $request)
    {
        $data = $request->validated();
        $data['currency_icon'] = getCurrencyIcon($request->currency_name);

        Setting::updateOrCreate(['id' => 1], $data);

        toastr('Settings Updated Successfully!', 'success', 'Success');
        return redirect()->back();
    }
}
