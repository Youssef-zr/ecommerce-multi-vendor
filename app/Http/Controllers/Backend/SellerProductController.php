<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SellerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SellerProductDataTable $datatable)
    {
        return $datatable->render('admin.product.seller-product.index');
    }

    public function changeApproved(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->fill(['is_approved' => $request->isApproved])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    public function filter(DataTables $dataTables)
    {

        $model = Product::query();

        return $dataTables->eloquent($model)
            ->filter(function ($query) {
                if (request()->has('approved')) {
                    $query->where('is_approved', request('approved'));
                }

                if (request()->has('status')) {
                    $query->where('status', request('status'));
                }
                if (request()->has('vendor')) {
                    $query->where('vendor_id', request('vendor'));
                }
            })
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
