<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Product::with(['inventory', 'sizes', 'productCategory', 'brand'])->paginate(10);
        return Inertia::render('Inventory', [
            'inventory' => $inventory
        ]);
    }

    public function edit ($id)
    {
        $product = Inventory::findorFail($id);
        return response(302);
    }

    public function update(Request $request, $id, Inventory $inventory)
    {
        $this->authorize('update', $inventory);
        
        $this->validate($request, ([
            'quantity'  => ['required', 'integer']
        ]));

        Auth::user()->inventories()->where('id', $id)->update([
            'quantity' => $request->quantity
        ]);

        return response(200);
    }
}
