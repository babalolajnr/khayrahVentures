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

        $this->validate($request, ([
            'name' => ['required', 'unique:sizes', 'regex:/^[0-9]{1,2}[in]+[x ]+[0-9]{1,2}[in]+[x ]+[0-9]{1,2}[in]{2}/m'],
            'productCategory' => ['required']
        ]), $messages);

        $productCategory = $request->productCategory;
        $productCategoryID = Product_Category::where('name', $productCategory)->first();
        $productCategoryID = $productCategoryID->id;
        // dd($productCategoryID->id);

        Auth::user()->sizes()->create([
            'name'              => $request->name,
            'products_category_id'   => $productCategoryID
        ]);

        return redirect('/addNewSize');
    }
}
