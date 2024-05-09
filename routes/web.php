<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Frontend\ProfileController,
    Frontend\UserController,
    Frontend\HomeController,
    Frontend\FrontProductController,
};
use App\Http\Controllers\Frontend\FlashSaleController;

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
Route::group(['prefix' => 'user/dashboard', "as" => "user.dashboard", 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [UserController::class, 'dashboard'])->name('.index');
    Route::get('profile', [UserController::class, 'edit'])->name('.profile.index');
    Route::put('profile', [UserController::class, 'update'])->name('.profile.update');
    Route::put('update-password', [UserController::class, 'updatePassword'])->name('.password.update');
});

// frontend pages
Route::group(['as'=>'frontend.'],function(){

    // Home controller
    Route::get('/', [HomeController::class, 'index'])->name('index');

    // flash sale route
    Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

    // product detail route
    Route::get('product-details/{slug}',[FrontProductController::class,'productDetail'])->name('product_detail');
});
