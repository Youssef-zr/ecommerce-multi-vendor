<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShippingRule\StoreShippingRuleRequest;
use App\Http\Requests\Backend\ShippingRule\UpdateShippingRuleRequest;
use App\Models\Backend\ShippingRule;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRuleDataTable $datatable)
    {
        return $datatable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingRuleRequest $request)
    {
        $data = $request->validated();
        ShippingRule::create($data);

        toastr('Rule Adedd Successfully1', 'success', 'Success');

        return to_route('admin.dashboard.shipping-rule.index');
    }

    public function changeStatus(Request $request)
    {
        $coupon = ShippingRule::findOrFail($request->id);
        $status = $request->isChecked == "true" ? 'active' : 'inactive';

        $coupon->fill(['status' => $status])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingRule $shippingRule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingRule $shippingRule)
    {
        return view('admin.shipping-rule.update', compact('shippingRule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingRuleRequest $request, ShippingRule $shippingRule)
    {

        $data = $request->validated();
        $shippingRule->update($data);

        toastr('Rule Updated Successfully1', 'success', 'Success');

        return to_route('admin.dashboard.shipping-rule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingRule $shippingRule)
    {
        $shippingRule->delete();
        return response()->json(['success' => 'ok'], 200);
    }
}
