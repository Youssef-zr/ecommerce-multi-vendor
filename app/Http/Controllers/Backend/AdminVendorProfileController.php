<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Vendor\UpdateVendorRequest;
use App\Models\Backend\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminVendorProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $vendor =  Vendor::where('user_id', Auth()->user()->id)->first();
        return view('admin.vendor-profile.index', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request)
    {
        $vendor =  Vendor::where('user_id', auth()->user()->id)->first();

        $data = $request->validated();
        $data['banner'] = $vendor->updateBanner(); // return the pathFF
        $vendor->fill($data)->save();

        toastr()->success('Vendor Info Updated Successfully', 'Ok!');

        return redirect()->back();
    }
}
