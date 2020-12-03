<?php

namespace Tests\Feature;

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
    public function testInventoryStoreMethod()
    {
        $user = User::factory()->create();
        $product = Product::pluck('name')->all();
        // $product = Product::factory()->create();
        // dd($product);
        $product = Arr::random($product);
        // dd($product);
        $quantity = mt_rand(0,100);

        $response = $this->actingAs($user)->post('/submitInventory',[
            'product'   => $product,
            'quantity'  => $quantity
        ]);

        $response->assertStatus(302);
    }
}
