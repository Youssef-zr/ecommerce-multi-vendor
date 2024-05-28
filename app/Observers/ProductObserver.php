<?php

namespace App\Observers;

use App\Helpers\ImageUpload;
use App\Models\Backend\Product;
use App\Models\Backend\ProductVariant;
use App\Models\Backend\ProductVariantItem;
use Illuminate\Support\Str;

class ProductObserver
{

    public function isAdmin()
    {
        $user = auth()->user();
        return $user->role == 'admin' ? true : false;
    }

    public function creating(Product $product)
    {
        $product->slug = str::slug($product->name);
        $product->vendor_id = Auth()->user()->vendor->id;

        if($this->isAdmin()){
            $product->is_approved = 'approved';
        }

        self::uploadImage($product);
    }

    public function updating(Product $product)
    {
        $product->slug = Str::slug($product->name);

        self::uploadImage($product);
    }


    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
    }

    public static function uploadImage($product)
    {

        if (request()->hasFile("thumb_image")) {
            $productsFolder = 'uploads/products';
            makeDir($productsFolder);

            $productPath = $productsFolder . '/thumbnails';
            makeDir($productPath);

            $fileInfo = ImageUpload::update([
                'file' => request()->file('thumb_image'),
                "storagePath" => $productPath,
                "old_image" => $product->thumb_image,
                "default" => $product->thumb_image,
                "height" => 350,
                "width" => null,
                "quality" => 100
            ]);

            $product->thumb_image = $fileInfo['file_path'];
        }
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleting(Product $product): void
    {
        // delete image thumbnail
        ImageUpload::delete([
            "old_image" => $product->thumb_image,
            "default" => $product->thumb_imagee,
        ]);

        // delete image gallery
        $imageGallery = $product->imageGallery;

        if ($imageGallery->count() > 0) {

            foreach ($imageGallery as $fileItem) {
                ImageUpload::delete([
                    "old_image" => $fileItem->image,
                    "default" => $fileItem->imagee,
                ]);

                $fileItem->delete();
            }

            // remove product folder if empty
            $path = 'uploads/products/gallery/' . $product->id;
            removeDir($path);
        }

        // delete variants
        $productVariants = $product->variants;
        if ($productVariants->count() > 0) {
            ProductVariant::destroy($productVariants->pluck('id')->toArray());
        }

        // delete variants items
        $productVariantItems = $product->variantItems;
        if ($productVariantItems->count() > 0) {
            ProductVariantItem::destroy($productVariantItems->pluck('id')->toArray());
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
