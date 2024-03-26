<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\DataTables\Vendor\VendorProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductVariantItem\StoreVariantItemRequest;
use App\Http\Requests\Backend\ProductVariantItem\UpdateVariantItemRequest;
use App\Models\Backend\Product;
use App\Models\Backend\ProductVariant;
use App\Models\Backend\ProductVariantItem;
use Illuminate\Http\Request;

class VendorProductVariantItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductVariantItemDataTable $datatable, $productId, $variantId)
    {

        $product = Product::where("vendor_id", auth()->user()->vendor->id)
            ->findOrFail($productId);

        $variant = ProductVariant::where('product_id', $product->id)
            ->findOrFail($variantId);

        return $datatable->render('vendor.product.variant-item.index', compact('variant', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($variantId)
    {
        $variant = ProductVariant::whereHas('product', function ($q) {
            $q->where('vendor_id', auth()->user()->vendor->id);
        })->findOrFail($variantId);

        return view('vendor.product.variant-item.create', compact('variant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVariantItemRequest $request, $variantId)
    {
        $variant = ProductVariant::whereHas('product', function ($q) {
            $q->where('vendor_id', auth()->user()->vendor->id);
        })->findOrFail($variantId);

        $data = $request->validated();
        $data['product_id'] = $variant->product_id;
        $data['variant_id'] = $variant->id;

        $newVariantItem = new ProductVariantItem;
        $newVariantItem->create($data);

        toastr('Variant Item Created Successfully!', 'success', 'Ok!');
        return to_route('vendor.dashboard.product-variant-item.index', ["productId" => $variant->product_id, "variantId" => $variant->id]);
    }

    public function changeStatus(Request $request)
    {
        $variant = ProductVariantItem::whereHas('product', function ($q) {
            $q->where('vendor_id', auth()->user()->vendor->id);
        })->findOrFail($request->id);

        $status = $request->isChecked == "true" ? 'active' : 'inactive';

        $variant->fill(['status' => $status])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariantItem $productVariantItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($variantItemId)
    {
        $variantItem = ProductVariantItem::whereHas('product', function ($q) {
            $q->where('vendor_id', auth()->user()->vendor->id);
        })->findOrFail($variantItemId);

        $variant = $variantItem->variant;

        return view('vendor.product.variant-item.edit', compact('variantItem', 'variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVariantItemRequest $request, $variantItemId)
    {
        $data = $request->validated();

        $variantItem = ProductVariantItem::whereHas('product', function ($q) {
            $q->where('vendor_id', auth()->user()->vendor->id);
        })->findOrFail($variantItemId);

        $variantItem->update($data);

        toastr('Variant item updated successfully!', 'success', 'Ok!');
        return to_route('vendor.dashboard.product-variant-item.index', ["productId" => $variantItem->product_id, "variantId" => $variantItem->variant_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($variantItemId)
    {
        $variantItem = ProductVariantItem::whereHas('product', function ($q) {
            $q->where('vendor_id', auth()->user()->vendor->id);
        })->findOrFail($variantItemId);

        $variantItem->delete();

        toastr('Variant item deleted successfully!', 'success', 'Ok!');
        return response()->json(['success' => 'ok'], 200);
    }
}
