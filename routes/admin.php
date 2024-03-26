<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\{
    AdminController,
    AdminVendorProfileController,
    Brandcontroller,
    CategoryController,
    ChildCategoryController,
    ProductController,
    ProductImageGalleryController,
    ProductVariantController,
    ProductVariantItemController,
    ProfileController,
    SellerProductController,
    SliderController,
    SubCategoryController,
};

/**
 *
 * admin routes
 *
 **/
Route::group(['prefix' => 'dashboard', 'as' => '.dashboard.', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('index');

    // slider routes
    Route::resource('/slider', SliderController::class);

    // category routes
    Route::put('/category/change-status', [CategoryController::class, 'changeStatus'])->name("category.change-status");
    Route::resource('/category', CategoryController::class);

    // sub category routes
    Route::get('/sub-category/get-childcategories', [SubCategoryController::class, 'getChildCategories'])->name("child-category.get-childcategories");
    Route::put('/sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name("sub-category.change-status");
    Route::resource('/sub-category', SubCategoryController::class);

    // child category routes
    Route::get('/child-category/get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name("child-category.get-subcategories");
    Route::put('/child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name("child-category.change-status");
    Route::resource('/child-category', ChildCategoryController::class);

    // brand routes
    Route::put('/brand/change-status', [Brandcontroller::class, 'changeStatus'])->name("brand.change-status");
    Route::put('/brand/change-featured-status', [Brandcontroller::class, 'changeIsFeaturedStatus'])->name("brand.change-featured-status");
    Route::resource('/brand', Brandcontroller::class);

    // vendor profile
    Route::get('/vendor-profile', [AdminVendorProfileController::class, 'edit'])->name('vendor-profile.edit');
    Route::put('/vendor-profile', [AdminVendorProfileController::class, 'update'])->name('vendor-profile.update');

    // product image gallery
    Route::resource('/product/image-gallery', ProductImageGalleryController::class)->only(['index', 'store', 'destroy']);

    // product routes
    Route::put('/product/change-status', [ProductController::class, 'changeStatus'])->name("product.change-status");
    Route::resource('/product', ProductController::class);

    // product variant routes
    Route::put('/product-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name("product-variant.change-status");
    Route::resource('/product-variant', ProductVariantController::class);

    // product variant item (options)
    Route::get('/product-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('product-variant-item.index');

    Route::get('/product-variant-item/{variantId}', [ProductVariantItemController::class, 'create'])->name('product-variant-item.create');
    Route::post('/product-variant-item/{variantId}', [ProductVariantItemController::class, 'store'])->name('product-variant-item.store');

    Route::get('/product-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');
    Route::put('/product-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('product-variant-item.update');

    Route::delete('/product-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('product-variant-item.destroy');

    Route::put('/product-variant-item-status', [ProductVariantItemController::class, 'changeStatus'])->name('product-variant-item.change-status');

    // seller product show pending and active and filter and more...
    Route::get('seller-product', [SellerProductController::class,'index'])->name('seller-product.index');
    Route::get('seller-product-filter',[SellerProductController::class,'index'])->name('seller-product.filter');
    Route::put('product-change-approved', [SellerProductController::class,'changeApproved'])->name('seller-product.change-approved');
});



/**
 * auth routes
 * login
 *
 */

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AdminController::class, 'login'])->name('.login');
});

Route::group(['middleware' => ['auth', "role:admin"]], function () {

    Route::get('profile', [ProfileController::class, 'index'])->name('.profile.index');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('.profile.update');
    Route::put('profile/update-password', [ProfileController::class, 'updatePassword'])->name('.profile.update_password');
});
