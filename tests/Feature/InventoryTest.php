<?php

namespace Tests\Feature;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Arr;

class InventoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     //SEED DATABASE BEFORE RUNNING TESTS

     public function testUserCanViewInventory()
     {
        $user = User::factory()->create();
        // $user= User::find(1);
        $request = $this->actingAs($user)->get('/inventory');
        $request->assertStatus(200);
     }

    // public function testInventoryValidatesUniqueId()
    // {
    //     $user = User::factory()->create();

    //     $productID = Inventory::pluck('products_id')->all();

    //     $productID = Arr::random($productID);

    //     $product = Product::where('id', $productID)->first();

    //     $product = $product->name;

    //     $quantity = mt_rand(0,100);

    //     $response = $this->actingAs($user)->post('/submitInventory', [
    //         'product' => $product,
    //         'quantity' => $quantity
    //     ]);

    //     // $response->assertSessionHasErrors('product');
    //     $response->assertSessionHasErrors('product');
        
    // }

}
