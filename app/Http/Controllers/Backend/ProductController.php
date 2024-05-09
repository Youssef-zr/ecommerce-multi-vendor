<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\StoreProductRequest;
use App\Http\Requests\Backend\Product\UpdateProductRequest;
use App\Models\Backend\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $datatable)
    {
        return $datatable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = Arr::except($request->validated(), 'thumb_image');
        $product = new Product;
        $product->create($data);

        toastr()->success('Product created successfully!', 'Ok!');
        return to_route('admin.dashboard.product.index');
    }

    public function changeStatus(Request $request)
    {
        $subCategory = Product::findOrFail($request->id);
        $status = $request->isChecked == "true" ? 'active' : 'inactive';

        $subCategory->fill(['status' => $status])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = Arr::except($request->validated(), 'thumb_image');
        $product->update($data);

        // create this code to run productObserver (updating) method
        if ($request->hasFile('thumb_image')) {
            $product->fill(['name' => $product->name . " "])->save();
        }

        toastr()->success('Product Updated successfully!', 'Ok!');
        return to_route('admin.dashboard.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // removed in productObserver
        $product->delete();

        toastr()->success('Product deleted successfully!', 'Ok!');
        return response()->json(['success' => 'ok'], 200);
    }

}
