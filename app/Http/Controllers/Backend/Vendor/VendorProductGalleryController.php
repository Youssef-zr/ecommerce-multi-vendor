<?php

namespace App\Http\Controllers\Backend\Vendor;

use App\DataTables\Vendor\VendorProductImageGalleryDataTable;
use App\Helpers\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\ImageGallery\StoreProductImageGalleryRequest;
use App\Models\Backend\Product;
use App\Models\Backend\ProductImageGallery;
use Illuminate\Http\Request;

class VendorProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductImageGalleryDataTable $datatable)
    {
        $product = Product::where("vendor_id", auth()->user()->vendor->id)
            ->findOrFail($request->product);

        return $datatable->render('vendor.product.image-gallery.index', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductImageGalleryRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        if (request()->hasFile('image')) {

            $images = request()->file('image');

            foreach ($images as $image) {

                $galleryFolder = 'uploads/products/gallery';
                makeDir($galleryFolder);

                $productPath = $galleryFolder.'/'.$product->id;
                makeDir($productPath);

                $fileInfo = ImageUpload::update( [
                    'file' => $image,
                    "storagePath" => $productPath,
                    "old_image" => $product->image,
                    "default" => $product->image,
                    "height" => null,
                    "width" => 800,
                    "quality" => 100
                ]);

                $productImageGallery = new ProductImageGallery;
                $productImageGallery->fill([
                    'image' => $fileInfo['file_path'],
                    'product_id' => $product->id
                ])->save();
            }
        }

        toastr()->success('Images has been uploaded successfully !', "Success");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = ProductImageGallery::findOrFail($id);

        $imageProps = [
            "old_image" => $file->image,
            "default" => $file->image,
        ];

        ImageUpload::delete($imageProps);

        $file->delete();

        toastr()->success('Image Has Been Deleted Successfully', "Success");

        return response()->json(['success' => 'ok'], 200);
    }
}
