<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class BrandController extends Controller
{
    public function index()
    {
        return Inertia::render('AddNewBrand');

    }

    public function store(Request $request)
    {
        $messages = [
            'unique' => 'Brand Exists'
        ];  

        $this->validate($request, array(
            'name' => 'required|unique:brands',
        ), $messages);

        Auth::user()->brands()->create([
            'name' => $request->name, 
        ]);

        return redirect('/addNewBrand');

    }
}
