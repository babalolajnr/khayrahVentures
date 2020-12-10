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
    // public function testInventoryStoreMethod()
    // {
    //     $user = User::factory()->create();
    //     $product = Product::pluck('name')->all();
        
    //     $product = Arr::random($product);
    //     $quantity = mt_rand(0,100);

    //     $response = $this->actingAs($user)->post('/submitInventory',[
    //         'product'   => $product,
    //         'quantity'  => $quantity
    //     ]);

    //     $response->assertStatus(302);
    // }

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

    // public function testInventoryValidationFailure()
    // {
    //     $user = User::factory()->create();
    //     $product = Product::pluck('name')->all();

    //     $product = Arr::random($product);
    // }
}
