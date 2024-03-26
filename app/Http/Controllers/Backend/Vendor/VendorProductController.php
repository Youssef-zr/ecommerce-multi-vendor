<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\DataTables\Vendor\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\vendor\product\UpdateProductRequest;
use App\Http\Requests\Backend\vendor\Product\StoreProductRequest;
use App\Models\Backend\Category;
use App\Models\Backend\Product;
use App\Models\Backend\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class VendorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $datatable)
    {
        return $datatable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = Arr::except($request->validated(), 'thumb_image');
        $data['is_approved'] = 'pending';
        $product = new Product;
        $product->create($data);

        toastr()->success('Product created successfully!', 'Ok!');
        return to_route('vendor.dashboard.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        $variant = Product::findOrFail($request->id);
        $status = $request->isChecked == "true" ? 'active' : 'inactive';

        $variant->fill(['status' => $status])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('vendor_id', auth()->user()->vendor->id)
            ->findOrFail($id);

        return view('vendor.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::where('vendor_id', auth()->user()->vendor->id)
            ->findOrFail($id);

        $data = Arr::except($request->validated(), 'thumb_image');
        $product->fill($data)->save();

        // create this code to run productObserver (updating) method
        if ($request->hasFile('thumb_image')) {
            $product->fill(['name' => $product->name . " "])->save();
        }

        toastr()->success('Product Updated successfully!', 'Ok!');
        return to_route('vendor.dashboard.product.index');
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

    public function getSubCategories(Request $request)
    {
        $mainCategory = Category::with(['subCategories' => function ($query) {
            return $query->whereStatus('active');
        }])->findOrFail($request->mainCategoryId);


        $subCategories = $mainCategory->subCategories
            ->pluck('name', "id")->toArray();

        $output = '<option value="">please select</option>';

        foreach ($subCategories as $key => $value) {
            $output .= '<option value=' . $key . '>' . $value . '</option>';
        }

        return response()->json(['data' => $output], 200);
    }

    // get child categories
    public function getChildCategories(Request $request)
    {
        $subCategory = SubCategory::with(['childCategories' => function ($query) {
            return $query->whereStatus('active');
        }])->findOrFail($request->subCategoryId);

        $childCategories = $subCategory->childCategories
            ->pluck('name', "id")->toArray();

        $output = '<option value="">please select</option>';

        foreach ($childCategories as $key => $value) {
            $output .= '<option value=' . $key . '>' . $value . '</option>';
        }

        return response()->json(['data' => $output], 200);
    }
}
