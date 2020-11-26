<?php

namespace App\Http\Controllers;

use App\Models\Product_Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SizeController extends Controller
{
    public function index()
    {
        $productCategories = Product_Category::all();
        // dd($productCategories);
        
        return Inertia::render('AddNewSize', [
            'productCategories' => $productCategories
        ]);
    }
}
