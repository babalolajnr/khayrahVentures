<?php

namespace App\Http\Controllers;

use App\Models\Product_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function store(Request $request)
    {
        $messages = [
            'unique' => 'Size Exists'
        ];  

        $this->validate($request, array(
            'name' => 'required|unique:sizes',
            'name2' => 'unique:sizes',
            'name3' => 'unique:sizes',
            'productCategory' => 'required'
        ), $messages);

        $productCategory = $request->productCategory;
        $productCategoryID = Product_Category::where('name', $productCategory)->first();
        $productCategoryID = $productCategoryID->id;
        // dd($productCategoryID->id);

        Auth::user()->sizes()->create([
            'name'              => $request->name, 
            'name2'                 => $request->name2,
            'name3'                  => $request->name3,
            'products_category_id'   => $productCategoryID
        ]);

        return redirect('/addNewSize');

    }
}
