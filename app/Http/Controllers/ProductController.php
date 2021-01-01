<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Validator;

class ProductController extends Controller
{

    /**
     * DONE
     * index
     * store
     * edit
     * update
     * destroy
     * 
     * TODO
     */

    public function create()
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

        $this->authorize('create', Product::class);

        Product::validateIncomingRequest($request);

        //get the size ID
        $size = $request->size;
        $sizeID = Size::where('name', $size)->first();
        $sizeID = $sizeID->id;

        //check if the product is already in the database
        $checkDatabase = Product::where('name', $request->name)->get();
        $checkDatabase = $checkDatabase->contains('size_id', $sizeID);
        
        if ($checkDatabase) {
            throw ValidationException::withMessages(['name' => 'Product Exists!']);
        }

        //get the product category ID
        $productCategory = $request->productCategory;
        $productCategoryID = ProductCategory::where('name', $productCategory)->first();
        $productCategoryID = $productCategoryID->id;


        //get brandID
        $brand = $request->brand;
        $brandID = Brand::where('name', $brand)->first();
        $brandID = $brandID->id;

        $slug = Str::of($request->name)->slug('-');

        //check if user filled in the quantity
        if (empty($request->quantity)) {
            $quantity = 0;
        } else {
            $quantity = $request->quantity;
        }

        $inventory = Inventory::create([
            'quantity'      =>  $quantity,
        ]);

         Auth::user()->products()->create([
            'name'                      => $request->name,
            'slug'                      => $slug,
            'code'                      => $request->code,
            'color'                     => $request->color,
            'wholesale_price'           => $request->wholesale,
            'retail_price'              => $request->retail,
            'size_id'                   => $sizeID,
            'brand_id'                  => $brandID,
            'product_category_id'       => $productCategoryID,
            'inventory_id'              => $inventory->id,
        ]);

        


        return redirect('/addNewProduct');
    }

    public function edit($id)
    {
        $product = Product::findorFail($id);

        return Inertia::render('EditProduct', [
            'product' => $product
        ]);
    }

    public function update(Request $request, $id, Product $product)
    {
        $this->authorize('update', $product);
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

        return redirect('/editProduct/' . $id);
    }

    public function destroy($id, Product $product)
    {
        $this->authorize('delete', $product);

        $product = Product::find($id);
        $product->delete();

        //delete the product from the inventory
        $inventory = Inventory::where('product_id', $id)->delete();

        // $inventory->delete();

        return response(200);
    }
}
