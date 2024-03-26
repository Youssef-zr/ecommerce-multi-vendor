<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\{
    VendorController,
    Vendor\VendorProductcontroller,
    Vendor\VendorProductGalleryController,
    Vendor\VendorProductVariantController,
    Vendor\VendorShopProfileController,
    Vendor\VendorProductVariantItemsController,
};

/**
 *
 * vendor routes
 *
 **/

// dashboard route
Route::get('/', [VendorController::class, 'dashboard'])->name('index');

// profile routes
Route::get('profile', [VendorController::class, 'edit'])->name('profile.index');
Route::put('profile', [VendorController::class, 'update'])->name('profile.update');
Route::put('upate-password', [VendorController::class, 'updatePassword'])->name('password.update');

// shop profile routes
Route::resource('shop-profile', VendorShopProfileController::class)->only(['index', 'update']);

// product routes
Route::put('product/change-status', [VendorProductController::class, 'changeStatus'])->name("product.change-status");
Route::resource('product', VendorProductController::class);

// subCategory and childCategory routes
Route::get('product-get-sub-categories', [VendorProductController::class, 'getSubCategories'])->name('get-subcategories');
Route::get('product-get-child-categories', [VendorProductController::class, 'getChildCategories'])->name('get-childCategories');

// product gallery images routes
Route::resource('product-image-gallery', VendorProductGalleryController::class)->only(['index', 'store', 'destroy']);

// product variant routes
Route::put('product-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name("product-variant.change-status");
Route::resource('product-variant', VendorProductVariantController::class);

// product variant item (options)
Route::get('product-variant-item/{productId}/{variantId}', [VendorProductVariantItemsController::class, 'index'])->name('product-variant-item.index');

Route::get('product-variant-item/{variantId}', [VendorProductVariantItemsController::class, 'create'])->name('product-variant-item.create');
Route::post('product-variant-item/{variantId}', [VendorProductVariantItemsController::class, 'store'])->name('product-variant-item.store');

Route::get('product-variant-item-edit/{variantItemId}', [VendorProductVariantItemsController::class, 'edit'])->name('product-variant-item.edit');
Route::put('product-variant-item-update/{variantItemId}', [VendorProductVariantItemsController::class, 'update'])->name('product-variant-item.update');

Route::delete('product-variant-item/{variantItemId}', [VendorProductVariantItemsController::class, 'destroy'])->name('product-variant-item.destroy');
Route::put('product-variant-item-status', [VendorProductVariantItemsController::class, 'changeStatus'])->name('product-variant-item.change-status');
