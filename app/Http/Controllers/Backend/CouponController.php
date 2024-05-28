<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Coupon\StoreCouponRequest;
use App\Http\Requests\Backend\Coupon\UpdateCouponRequest;
use App\Models\Backend\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $datateble)
    {
        return $datateble->render('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
        $data = $request->validated();
        Coupon::create($data);

        toastr('Coupon Adedd Successfully!', 'success', 'Success');
        return to_route('admin.dashboard.coupon.index');
    }

    public function changeStatus(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        $status = $request->isChecked == "true" ? 'active' : 'inactive';

        $coupon->fill(['status' => $status])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.update', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $data = $request->validated();
        $coupon->update($data);

        toastr('Coupon Updated Successfully!', 'success', 'Success');
        return to_route('admin.dashboard.coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return response()->json(['success' => 'ok'], 200);
    }
}
