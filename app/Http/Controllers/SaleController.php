<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * DONE
     * store
     * 
     * TODO
     * index
     * edit
     * update
     * destroy
     */

    public function store(Request $request)
    {
        $productAvailableQuantity = Inventory::where('product_id', $request->product_id)->pluck('quantity')->first();

        $this->validate($request, ([
            'product_id'                => ['required', 'integer'],
            'quantity'                  => ['required', 'integer', 'max:' . $productAvailableQuantity],
            'customer_firstname'        => ['required', 'string'],
            'customer_lastname'         => ['required', 'string'],
            'customer_phone_number'     => ['required', 'unique:customers,phone_number'],
            'customer_email'            => ['required', 'unique:customers,email', 'email'],
            'address'                   => ['string']
        ]));

        //create customer
        $customer = Auth::user()->customers()->create([
            'firstname'     => $request->customer_firstname,
            'lastname'      => $request->customer_lastname,
            'phone_number'  => $request->customer_phone_number,
            'email'         => $request->customer_email,
            'address'       => $request->address
        ]);


        //create sale
        $productID = $request->product_id;
        $productPrice = Product::where('id', $productID)->pluck('retail_price')->first();
        $quantity = $request->quantity;
        $amount = $productPrice * $quantity;

        $sale = Auth::user()->sales()->create([
            'product_id'    => $productID,
            'quantity_sold' => $quantity,
            'amount'        => $amount,
            'customer_id'   => $customer->id,
        ]);


        $quantitySold = $sale->quantity_sold;
        $remainingQuantity = $productAvailableQuantity - $quantitySold;

        $inventory = Inventory::where('product_id', $productID)->first();
        $inventory->quantity = $remainingQuantity;
        $inventory->save();

        return response(200);
    }
}
