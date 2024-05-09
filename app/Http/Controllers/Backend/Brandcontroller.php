<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Helpers\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Brand\StoreBrandRequest;
use App\Http\Requests\Backend\Brand\UpdateBrandRequest;
use App\Models\Backend\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class Brandcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $datatable)
    {
        return $datatable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $data = Arr::except($request->validated(), 'image');
        $data['slug'] = str()->slug($data["name"]);

        $brand = new Brand;
        $brand->fill($data)->save();

        self::uploadBrandImage($brand);

        toastr()->success('Brand created successfully', 'Ok');
        return to_route('admin.dashboard.brand.index');
    }


    public function changeStatus(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        $status = $request->isChecked == "true" ? 'active' : 'inactive';

        $brand->fill(['status' => $status])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    public function changeIsFeaturedStatus(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        $is_featured = $request->isChecked == "true" ? 'active' : 'inactive';

        $brand->fill(['is_featured' => $is_featured])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $data = Arr::except($request->validated(), 'image');
        $data['slug'] = str()->slug($data["name"]);

        $brand->fill($data)->save();

        self::uploadBrandImage($brand);

        toastr()->success('Brand updated successfully', 'Ok');

        return to_route('admin.dashboard.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {

        $imageProps = [
            "old_image" => $brand->image,
            "default" => $brand->image,
        ];

        ImageUpload::delete($imageProps);

        $brand->delete();

        return response()->json(['success' => 'ok'], 200);
    }

    public static function uploadBrandImage($brand)
    {
        if (request()->hasFile("image")) {
            makeDir('uploads/brands');

            $imageProps = [
                'file' => request()->file('image'),
                "storagePath" => "uploads/brands",
                "old_image" => $brand->image,
                "default" => $brand->image,
                "height" => null,
                "width" => 110,
                "quality" => 100
            ];

            $fileInfo = ImageUpload::update($imageProps);
            $brand->fill(['image' => $fileInfo['file_path']])->save();
        }
    }
}
