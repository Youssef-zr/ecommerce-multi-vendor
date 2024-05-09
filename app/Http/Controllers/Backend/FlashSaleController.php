<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\FlashSaleItemDataTable;
use App\Http\Requests\Backend\FlashSaleItems\UpdateFlashSaleItemRequest;
use App\Models\Backend\FlashSale;
use App\Models\Backend\FlashSaleItem;
use App\Models\Backend\Product;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FlashSaleItemDataTable $datatable)
    {
        $flashSale = FlashSale::first();

        $products = Product::orderBy('id', 'desc')
            ->whereStatus('active')
            ->where('is_approved', 'approved')
            ->pluck('name', 'id')
            ->toArray();

        return $datatable->render('admin.flash-sale.index', compact('flashSale', 'products'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FlashSale $flashSale)
    {
        $request->validate(['end_date' => 'required|date']);
        FlashSale::updateOrCreate(
            ['id' => 1],
            ['end_date' => $request->end_date]
        );

        toastr('Updated Successfully!', 'success', 'Success');
        return redirect()->back();
    }

    // flash sale add products
    public function addProduct(UpdateFlashSaleItemRequest $request)
    {

        $data = $request->validated();
        $data['flash_sale_id'] = FlashSale::first()->id;

        FlashSaleItem::updateOrCreate(
            ['product_id'=>$data['product_id']],
            $data
        );

        toastr('Product Adedd Successfully!', 'success', 'Success');
        return redirect()->back();
    }

    // flash sale change product status
    public function changeStatus(Request $request)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $status = $request->isChecked == "true" ? 'active' : 'inactive';

        $flashSaleItem->fill(['status' => $status])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    // flash sale change product show_at_home status
    public function showHomeStatus(Request $request)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $showHomeStatus = $request->isChecked == "true" ? 'yes' : 'no';

        $flashSaleItem->fill(['show_at_home' => $showHomeStatus])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    // flash sale delete product
    public function deleteProduct($id)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($id);
        $flashSaleItem->delete();

        toastr('Product Deleted Successfully!', 'success', 'Success');
        return response()->json(['success' => 'ok'], 200);
    }
}
