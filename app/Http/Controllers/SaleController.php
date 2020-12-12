<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $productAvailableQuantity = Inventory::where('products_id', $request->product_id)->pluck('quantity')->first();

        $this->validate($request, ([
            'product_id'                => ['required','integer'],
            'quantity'                  => ['required','integer', 'max:'.$productAvailableQuantity],
            'customer_firstname'        => ['required','string'],
            'customer_lastname'         => ['required','string'],
            'customer_phone_number'     => ['required', 'unique:customers,phone_number'],
            'customer_email'            => ['required', 'unique:customers,email', 'email'],
            'address'                   => ['string']
        ]));
        
        $productID = $request->product_id;
        Auth::user()->sales()->create([

        ]);
        return response(200);
    }
}
