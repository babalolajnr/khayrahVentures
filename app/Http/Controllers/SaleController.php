<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Sale;
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
        $inventoryID = Product::where('id', $request->product_id)->pluck('inventory_id')->first();
        $productAvailableQuantity = Inventory::where('id', $inventoryID)->pluck('quantity')->first();

        Sale::validateIncomingRequest($request, $productAvailableQuantity);

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

        //generate a unique reference string
        do {
            $reference = Str::random(10);
            $checkReference = Sale::where('reference', $reference)->get();
        } while (!$checkReference->isEmpty());

        //persist the sale in the database
        $sale = Auth::user()->sales()->create([
            'product_id'    => $productID,
            'quantity_sold' => $quantity,
            'amount'        => $amount,
            'customer_id'   => $customer->id,
            'reference'     => $reference,
        ]);

        //update the inventory    
        $quantitySold = $sale->quantity_sold;
        $remainingQuantity = $productAvailableQuantity - $quantitySold;

        $inventory = Inventory::where('id', $inventoryID)->first();
        $inventory->quantity = $remainingQuantity;
        $inventory->save();

        return response(200);
    }

    public function edit($id)
    {
        $sale = Sale::findorFail($id);

        return response(200);
    }

    // public function update($id, Request $request, Sale $sale)
    // {
    //     $this->authorize('update', $sale);
        
    //     $productAvailableQuantity = Inventory::where('product_id', $request->product_id)->pluck('quantity')->first();
    //     Sale::validateIncomingRequest($request, $productAvailableQuantity);

    //     $sale = Sale::where('id', $id)->first();
    //     $sale->quantity_sold = $request->quantity;
    //     $sale->amount = $request->amount;

    // }
}
