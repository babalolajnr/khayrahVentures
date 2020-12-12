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
    public function store(Request $request)
    {
        $productAvailableQuantity = Inventory::where('product_id', $request->product_id)->pluck('quantity')->first();

        $this->validate($request, ([
            'product_id'                => ['required','integer'],
            'quantity'                  => ['required','integer', 'max:'.$productAvailableQuantity],
            'customer_firstname'        => ['required','string'],
            'customer_lastname'         => ['required','string'],
            'customer_phone_number'     => ['required', 'unique:customers,phone_number'],
            'customer_email'            => ['required', 'unique:customers,email', 'email'],
            'address'                   => ['string']
        ]));
        

        $slug = Str::of($request->firstname.' '.$request->lastname, '-');
        //create customer
        $customer = Auth::user()->customers()->create([
            'firstname'     => $request->customer_firstname,
            'lastname'      => $request->customer_lastname,
            'phone_number'  => $request->customer_phone_number,
            'email'         => $request->customer_email,
            'slug'          => $slug,
            'address'       => $request->address
        ]);



        //create sale
        $productID = $request->product_id;
        $productPrice = Product::where('id', $productID)->pluck('retail_price')->first();
        $quantity = $request->quantity;
        $amount = $productPrice * $quantity;
        // dd($customer->id);


        $sale = Auth::user()->sales()->create([
            'product_id'    => $productID,
            'quantity_sold' => $quantity,
            'amount'        => $amount,
            'customer_id'   => $customer->id,
        ]);
        // $exception = new Exception;
        // dd($exception->getMessage());

        // dd($sale);


        $quantitySold = $sale->quantity_sold;
        $remainingQuantity = $productAvailableQuantity - $quantitySold;

        Auth::user()->inventories()->where('product_id', $productID)->update([
            'quantity' => $remainingQuantity        
        ]);

        return response(200);
    }
}
