<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    Frontend\UserController,
    Frontend\HomeController,
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
Route::group(['prefix' => 'user/dashboard', "as" => "user.dashboard", 'middleware' => ['auth', 'verified']], function () {

    Route::get('/', [UserController::class, 'dashboard'])->name('.index');
    Route::get('profile', [UserController::class, 'edit'])->name('.profile.index');
    Route::put('profile', [UserController::class, 'update'])->name('.profile.update');
    Route::put('update-password', [UserController::class, 'updatePassword'])->name('.password.update');
});

// Home controller
Route::get('/', [HomeController::class, 'index'])->name('frontend.index');
