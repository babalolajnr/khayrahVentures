<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductCategoriesController extends Controller
{
    public function index () 
    {
        return Inertia::render('AddNewCategory');
    }

    public function store(Request $request) 
    {
        $this->validate($request, array(
            'categoryName' => 'required'
        ));

        Auth::user()->product_categories()->create([
            'name' => $request->categoryName
        ]);

        // return redirect('/addNewCategory');
        // return response()->json([
        //     'success' => 'Category Created!'
        // ], 200);

        return Inertia::render('AddNewCategory', [
            'success' => 'Category Created!'
        ]);
    }
}
