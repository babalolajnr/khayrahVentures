<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SizeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware(['auth:sanctum', 'verified', 'handleInertiaRequests'])->group(function () {

    //home route
    Route::get('/', [HomeController::class, 'index'])->name('Home');

    //product categories route
    Route::get('/addNewCategory', [ProductCategoriesController::class, 'create'])->name('AddNewCategory');
    Route::get('/editProductCategory/{id}', [ProductCategoriesController::class, 'edit']);
    Route::post('/submitNewCategory', [ProductCategoriesController::class, 'store']);
    Route::patch('/updateProductCategory/{id}', [ProductCategoriesController::class, 'update']);
    Route::delete('/deleteProductCategory/{id}', [ProductCategoriesController::class, 'destroy']);

    //brand routes
    Route::get('/addNewBrand', [BrandController::class, 'create'])->name('AddNewBrand');
    Route::get('/editBrand/{id}', [BrandController::class, 'edit'])->name('EditBrand');
    Route::post('/submitNewBrand', [BrandController::class, 'store']);
    Route::patch('/updateBrand/{id}', [BrandController::class, 'update']);
    Route::delete('/deleteBrand/{id}', [BrandController::class, 'destroy']);

    //size routes
    Route::get('/addNewSize', [SizeController::class, 'create'])->name('AddNewSize');
    Route::get('/editSize/{id}', [SizeController::class, 'edit'])->name('EditSize');
    Route::post('/submitNewSize', [SizeController::class, 'store']);

    //product routes
    Route::get('/addNewProduct', [ProductController::class, 'create'])->name('AddNewProduct');
    Route::get('/editProduct/{id}', [ProductController::class, 'edit'])->name('EditProduct');
    Route::post('/submitNewProduct', [ProductController::class, 'store']);
    Route::patch('/updateProduct/{id}', [ProductController::class, 'update']);
    Route::delete('/deleteProduct/{id}', [ProductController::class, 'destroy']);

    //inventory routes
    Route::get('/inventory', [InventoryController::class, 'index'])->name('Inventory');
    Route::get('/editInventory', [InventoryController::class, 'edit'])->name('EditInventory');
    Route::post('/submitInventory', [InventoryController::class, 'store']);
    Route::patch('/updateInventory/{id}', [InventoryController::class, 'update']);

    //sales routes
    Route::post('/sell', [SaleController::class, 'store']);
});
