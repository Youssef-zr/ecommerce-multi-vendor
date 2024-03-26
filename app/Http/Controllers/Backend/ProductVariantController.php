<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Variant\StoreVariantRequest;
use App\Http\Requests\Backend\Variant\UpdateVariantRequest;
use App\Models\Backend\Product;
use App\Models\Backend\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $datatable)
    {
        $product = Product::findOrFail($request->product);

        return $datatable->render('admin.product.variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $product_id = Product::findOrFail($request->product)->id;

        return view('admin.product.variant.create', compact('product_id'));
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
        return to_route('admin.dashboard.product-variant.index', ['product' => $data['product_id']]);
    }

    public function changeStatus(Request $request)
    {
        $variant = ProductVariant::findOrFail($request->id);
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
        $variant = ProductVariant::findOrFail($id);

        return view('admin.product.variant.edit', ['product_id' => $variant->product_id, 'variant' => $variant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVariantRequest $request, string $id)
    {

        $variant = ProductVariant::findOrFail($id);

        $data = $request->validated();
        $variant->fill($data)->save();

        toastr()->success('Variant updated successfully', 'Ok');
        return to_route('admin.dashboard.product-variant.index', ['product' => $data['product_id']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::with("variantItems")->findOrFail($id);

        if ($variant->variantItems->count() > 0) {
            return response()->json(['msg' => 'You cannot delete this variant because it is linked to another sub variants items.'], 409);
        }

        $variant->delete();
        toastr('Variant deleted successfully!', 'success', 'Ok!');

        return response()->json(['success' => 'ok'], 200);
    }
}
