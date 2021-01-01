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
        $sizeID = $this->getSizeID($request->size);

        //check if the product is already in the database
        $this->checkProductExists($sizeID, $request->name);

        //get the product category ID
        $productCategoryID = $this->getProductCategoryID($request->productCategory);

        //get brandID
        $brandID = $this->getBrandID($request->brand);

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

        $sizeID = $this->getSizeID($request->size);

        
        //check if the product is already in the database
        $this->checkProductExists($sizeID, $request->name);

        $productCategoryID = $this->getProductCategoryID($request->productCategory);
        $brandID = $this->brandID($request->brand);
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

    public function getSizeID($size)
    {
        $size = Size::where('name', $size)->first();
        $sizeID = $size->id;
        return $sizeID;
    }

    public function getBrandID($brand)
    {

        $brand = Brand::where('name', $brand)->first();
        $brandID = $brand->id;
        return $brandID;
    }

    public function getProductCategoryID($productCategory)
    {
        $productCategory = ProductCategory::where('name', $productCategory)->first();
        $productCategoryID = $productCategory->id;
        return $productCategoryID;
    }

    public function checkProductExists($sizeID, $name)
    {
        $checkDatabase = Product::where('name', $name)->get();
        $checkDatabase = $checkDatabase->contains('size_id', $sizeID);

        if ($checkDatabase) {
            throw ValidationException::withMessages(['name' => 'Product Exists!']);
        }
    }
}
