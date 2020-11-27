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

        $messages = [
            'unique' => 'Category Exists'
        ];

        $this->validate($request, array(
            'name' => 'required|unique:products_category'
        ), $messages);


        Auth::user()->productCategories()->create([
            'name' => $request->name
        ]);

        return redirect('/addNewCategory');
        
    }
}
