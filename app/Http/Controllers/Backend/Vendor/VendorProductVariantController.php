<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\DataTables\Vendor\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use App\Models\Backend\ProductVariant;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Variant\StoreVariantRequest;
use App\Http\Requests\Backend\Variant\UpdateVariantRequest;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductVariantDataTable $datatable)
    {

        $product = Product::where("vendor_id", auth()->user()->vendor->id)
            ->findOrFail($request->product);

        return $datatable->render('vendor.product.variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $productId = Product::where('vendor_id', auth()->user()->vendor->id)
            ->findOrFail($request->product)->id;

        return view('vendor.product.variant.create', compact('productId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVariantRequest $request)
    {
        $data = $request->validated();

        $variant = new ProductVariant;
        $variant->fill($data)->save();

        toastr()->success('Variant created successfully', 'Ok');
        return to_route('vendor.dashboard.product-variant.index', ['product' => $data['product_id']]);
    }

    public function changeStatus(Request $request)
    {
        $variant = ProductVariant::whereHas('product', function ($q) {
            $q->where('vendor_id', auth()->user()->vendor->id);
        })->findOrFail($request->id);

        $status = $request->isChecked == "true" ? 'active' : 'inactive';

        $variant->fill(['status' => $status])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariant $productVariant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $variant = ProductVariant::whereHas('product', function ($q) {
            $q->where('vendor_id', auth()->user()->vendor->id);
        })->findOrFail($id);

        return view('vendor.product.variant.edit', ['productId' => $variant->product_id, 'variant' => $variant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVariantRequest $request, string $id)
    {

        $variant = ProductVariant::whereHas('product', function ($q) {
            $q->where('vendor_id', auth()->user()->vendor->id);
        })->findOrFail($id);

        $data = $request->validated();
        $variant->fill($data)->save();

        toastr()->success('Variant updated successfully', 'Ok');
        return to_route('vendor.dashboard.product-variant.index', ['product' => $data['product_id']]);
    }

    /**
     * Remove the product
     * 1-Remove the specified resource from storage.
     * 2-Remove the variants and subVariants (variantItems)
     *  1 and 2 was removed with productObserver deleting method
     */
    public function destroy(string $id)
    {

        $variant = ProductVariant::whereHas('product', function ($q) {
            $q->where('vendor_id', auth()->user()->vendor->id);
        })->with("variantItems")->findOrFail($id);

        if ($variant->variantItems->count() > 0) {
            return response()->json(['msg' => 'You cannot delete this variant because it is linked to another sub variants items.'], 409);
        }

        $variant->delete();
        toastr('Variant deleted successfully!', 'success', 'Ok!');

        return response()->json(['success' => 'ok'], 200);
    }
}
