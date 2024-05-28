<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductImageGalleryDataTable;
use App\Helpers\ImageUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\ImageGallery\StoreProductImageGalleryRequest;
use App\Models\Backend\Product;
use App\Models\Backend\ProductImageGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductImageGalleryDataTable $datatable)
    {
        $product = Product::findOrFail($request->product);

        return $datatable->render('admin.product.image-gallery.index', compact('product'));
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
                    "height" => 350,
                    "width" => null,
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
