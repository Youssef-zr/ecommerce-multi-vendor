<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Vendor\UpdateVendorRequest;
use App\Models\Backend\Vendor;
use Illuminate\Http\Request;

class VendorShopProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendor = auth()->user()->vendor;

        return view('vendor.shop-profile.index', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, string $id)
    {

        $vendor = Vendor::findOrFail($id);

        $data = $request->validated();
        $data['banner'] = $vendor->updateBanner(); // return the path
        $vendor->fill($data)->save();

        toastr('Vendor updated successfully!', 'success', 'Ok!');

        return redirect()->back();
    }

}
