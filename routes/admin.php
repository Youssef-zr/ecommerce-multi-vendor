<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\{
    AdminController,
    AdminVendorProfileController,
    Brandcontroller,
    CategoryController,
    ChildCategoryController,
    CouponController,
    ProductController,
    ProductImageGalleryController,
    ProductVariantController,
    ProductVariantItemController,
    ProfileController,
    PaypalSettingController,
    SellerProductController,
    SliderController,
    SubCategoryController,
    FlashSaleController,
    GeneralSettingController,
    PaymentSettingsController,
    ShippingRuleController
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

    // coupons routes
    Route::put('/coupon/change-status', [CouponController::class, 'changeStatus'])->name('coupon.change-status');
    Route::resource('/coupon', CouponController::class);

    // shippin gule routes
    Route::put('/shipping-rule/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rule.change-status');
    Route::resource('/shipping-rule', ShippingRuleController::class);

    // seller product show pending and approve status and filter and more...
    Route::get('seller-product', [SellerProductController::class, 'index'])->name('seller-product.index');
    Route::get('seller-product-filter', [SellerProductController::class, 'index'])->name('seller-product.filter');
    Route::put('change-approve-status', [SellerProductController::class, 'changeApproved'])->name('seller-product.change-approved');

    // flash sale routes
    Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
    Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash-sale.update');
    Route::put('flash-sale/add-procuct', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
    Route::put('flash-sale/change-product-status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale.change-product-status');
    Route::put('flash-sale/show-home-pdocut', [FlashSaleController::class, 'showHomeStatus'])->name('flash-sale.show-home-status');
    Route::delete('flash-sale/delete-product/{id}', [FlashSaleController::class, 'deleteProduct'])->name('flash-sale.delete-product');

    // generale settings route
    Route::get('settings', [GeneralSettingController::class, 'index'])->name("settings.index");
    Route::put('general-settings-update/{id}', [GeneralSettingController::class, 'updateGeneralSetting'])->name("settings.update");

    // payment settings routes
    Route::get('payment-setting',[PaymentSettingsController::class,'index'])->name('payment-setting.index');

    // paypal settings
    Route::resource('paypal-setting', PaypalSettingController::class);

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
