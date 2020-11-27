<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoriesController;
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
    Route::get('/addNewBrand', [BrandController::class, 'index'])->name('AddNewBrand');
    Route::get('/addNewSize', [SizeController::class, 'index'])->name('AddNewSize');
    Route::post('/submitNewCategory', [ProductCategoriesController::class, 'store']);
    Route::post('/submitNewBrand', [BrandController::class, 'store']);
    Route::post('/submitNewSize', [SizeController::class, 'store']);
});
