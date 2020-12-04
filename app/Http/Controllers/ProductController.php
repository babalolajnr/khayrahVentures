<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Validator;

class ProductController extends Controller
{
    public function index()
    {

        $productCategories = ProductCategory::all();
        $sizes = Size::all();
        $brands = Brand::all();

        return Inertia::render('AddNewProduct', [
            'productCategories' => $productCategories,
            'sizes'             => $sizes,
            'brands'            => $brands
        ]);
    }

    public function store(Request $request)
    {

        Product::validateIncomingRequest($request);
        
        $productCategory = $request->productCategory;
        $productCategoryID = ProductCategory::where('name', $productCategory)->first();
        $productCategoryID = $productCategoryID->id;
        
        $size = $request->size;
        $sizeID = Size::where('name', $size)->first();
        $sizeID = $sizeID->id;
        
        $brand = $request->brand;
        $brandID = Brand::where('name', $brand)->first();
        $brandID = $brandID->id;
        $slug = Str::of($request->name)->slug('-');


        // dd($productCategoryID->id);

        Auth::user()->products()->create([
            'name'                      => $request->name,
            'slug'                      => $slug,
            'code'                      => $request->code,
            'color'                     => $request->color,
            'wholesale_price'           => $request->wholesale,
            'retail_price'              => $request->retail,
            'size_id'                   => $sizeID,
            'brand_id'                  => $brandID,
            'product_category_id'       => $productCategoryID
        ]);

        return redirect('/addNewProduct');
        
    }

    public function edit ($id)
    {
       $product = Product::find($id);

       return Inertia::render('EditProduct', [
           'product' => $product
       ]);

    }

    public function update (Request $request, $id)
    {
        Product::validateIncomingRequest($request);

        $productCategory = $request->productCategory;
        $productCategoryID = ProductCategory::where('name', $productCategory)->first();
        $productCategoryID = $productCategoryID->id;
        
        $size = $request->size;
        $sizeID = Size::where('name', $size)->first();
        $sizeID = $sizeID->id;
        
        $brand = $request->brand;
        $brandID = Brand::where('name', $brand)->first();
        $brandID = $brandID->id;
        $slug = Str::of($request->name)->slug('-');


        // dd($productCategoryID->id);

        Auth::user()->products()->where('id', $id)->update([
            'name'                      => $request->name,
            'slug'                      => $slug,
            'code'                      => $request->code,
            'color'                     => $request->color,
            'wholesale_price'           => $request->wholesale,
            'retail_price'              => $request->retail,
            'size_id'                   => $sizeID,
            'brand_id'                  => $brandID,
            'product_category_id'       => $productCategoryID
        ]);

        return redirect('/editProduct/'.$id);
    }
}
