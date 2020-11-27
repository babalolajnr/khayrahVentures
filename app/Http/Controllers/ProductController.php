<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {

        $productCategories = ProductCategory::all();
        $sizes = Size::all();
        $brands = Brand::all();

        return Inertia::render('AddNewProduct', [
            'productCategories' => $productCategories,
            'sizes' => $sizes,
            'brands' => $brands
        ]);
    }
}
