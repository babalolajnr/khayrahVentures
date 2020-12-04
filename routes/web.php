<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
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

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/addNewCategory', [ProductCategoriesController::class, 'index'])->name('AddNewCategory');
    Route::post('/submitNewCategory', [ProductCategoriesController::class, 'store']);

    Route::get('/addNewBrand', [BrandController::class, 'index'])->name('AddNewBrand');
    Route::post('/submitNewBrand', [BrandController::class, 'store']);

    Route::get('/addNewSize', [SizeController::class, 'index'])->name('AddNewSize');
    Route::post('/submitNewSize', [SizeController::class, 'store']);

    Route::get('/addNewProduct', [ProductController::class, 'index'])->name('AddNewProduct');
    Route::get('/editProduct/{id}', [ProductController::class, 'edit'])->name('EditProduct');
    Route::post('/submitNewProduct', [ProductController::class, 'store']);
    Route::patch('/updateProduct/{id}', [ProductController::class, 'update']);

    Route::get('/inventory', [InventoryController::class, 'index'])->name('Inventory');
    Route::post('/submitInventory', [InventoryController::class, 'store']);

});

