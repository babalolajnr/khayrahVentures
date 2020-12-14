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

        Brand::validateIncomingRequest($request);

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

    public function update($id, Request $request, Brand $brand)
    {
        $this->authorize('update', $brand);

        Brand::validateIncomingRequest($request);

        $brand = Brand::where('id', $id)->first();

        $brand->name = $request->name;

        $brand->save();

        return response(200);


    }
}
