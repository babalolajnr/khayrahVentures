<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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
        $this->authorize('create', Product::class );

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

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return response(200);
    }
}
