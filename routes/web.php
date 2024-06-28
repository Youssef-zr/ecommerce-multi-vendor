<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\{
    CartController,
    CheckOutController,
    ProfileController,
    UserController,
    HomeController,
    FrontProductController,
    FlashSaleController,
    PaymentController,
    UserAdressController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// User dashboard routes
Route::group(['prefix' => 'user', "as" => "user.", 'middleware' => ['auth', 'verified']], function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('index');
    Route::get('profile', [UserController::class, 'edit'])->name('profile.index');
    Route::put('profile', [UserController::class, 'update'])->name('profile.update');
    Route::put('update-password', [UserController::class, 'updatePassword'])->name('password.update');
    Route::resource('adress', UserAdressController::class);

    // checkout routes
    Route::get('check-out', [CheckOutController::class, 'index'])->name('checkout.index');
    Route::post('check-out/add-adress', [CheckOutController::class, 'addAdress'])->name('checkout.add-adress');
    Route::post('checkout/form-submit',[CheckOutController::class,'checkoutFormSubmit'])->name('checkout.form-submit');

    // payment routes
    Route::get('payment',[PaymentController::class,'index'])->name('payment');
    Route::get('payment-success',[PaymentController::class,'paymentSuccess'])->name('payment.success');

    // paypal routes
    Route::get('paypal/payment',[PaymentController::class,'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success',[PaymentController::class,'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel',[PaymentController::class,'paypalCancel'])->name('paypal.cancel');
});

// frontend pages
Route::group(['as' => 'frontend.'], function () {

    // Home controller
    Route::get('/', [HomeController::class, 'index'])->name('index');

    // flash sale route
    Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

    // product detail route
    Route::get('product-details/{slug}', [FrontProductController::class, 'productDetail'])->name('product_detail');

    // cart routes
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('cart.add-to-cart');
    Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart.cart-details');
    Route::post('update-product-qty', [CartController::class, 'updateProductQty'])->name('cart.update-product-qty');
    Route::get('clear-cart', [CartController::class, 'clearCart'])->name('cart.clear-items');
    Route::get('delete-cart-item', [CartController::class, 'deleteCartItem'])->name('cart.delete-item');

    // apply coupon
    Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
    Route::get('get-cart-total', [CartController::class, 'cartSubTotalHtmlContent'])->name('get-cart-total');
});


// Route::get('/test',function(){
//     return bcrypt(123456);
// });
