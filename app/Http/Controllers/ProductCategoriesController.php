<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductCategoriesController extends Controller
{

    /**
     * DONE
     * index
     * store
     * 
     * TODO
     * edit
     * update
     * destroy
     */
    public function create()
    {
        return Inertia::render('AddNewCategory');
    }

    public function store(Request $request)
    {
        $this->authorize('create', ProductCategory::class);

        ProductCategory::validateIncomingRequest($request);

        Auth::user()->productCategories()->create([
            'name' => $request->name
        ]);

        return redirect('/addNewCategory');
    }

    public function edit($id)
    {
        $productCategory = ProductCategory::findorFail($id);
        return response(200);
    }

    public function update($id, Request $request, ProductCategory $productCategory)
    {
        $this->authorize('update', $productCategory);

        ProductCategory::validateIncomingRequest($request);

        $productCategory = ProductCategory::findOrFail($id);

        $productCategory->name = $request->name;

        $productCategory->save();

        return response(200);
    }

    public function destroy($id, ProductCategory $productCategory)
    {
        $this->authorize('delete', $productCategory);

        $productCategory = ProductCategory::findOrFail($id);
        $productCategory->delete();
        
    }
}
