<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InventoryController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, ([
            'product'   =>  ['required'],
            'quantity'  =>  ['required', 'integer']
        ]));

        $product = $request->product;
        $product = Product::where('name', $product)->first();
        $productID = $product->id;
        $quantity = $request->quantity;

        Auth::user()->inventories()->create([
            'products_id'   =>  $productID,
            'quantity'      =>  $quantity
        ]);

        return redirect('/inventory');
    }
}
