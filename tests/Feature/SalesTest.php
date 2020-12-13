<?php

namespace Tests\Feature;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesTest extends TestCase
{
    use WithFaker;

    public function testSalesStoreMethod()
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $products = Inventory::where('quantity', '>', 0)->get();
        $product = $products->random();
        $productID = $product->id;
        $quantity = $product->quantity;
        $quantity = $quantity - 1;

        $request = $this->actingAs($user)->post('/sell', [
            'product_id'            => $productID,
            'quantity'              => $quantity,
            'customer_firstname'    => $this->faker->firstName(),
            'customer_lastname'     => $this->faker->lastName,
            'customer_phone_number' => $this->faker->e164PhoneNumber,
            'customer_email'        => $this->faker->email,
            'address'               => $this->faker->address
        ]);

        $request->assertStatus(200);
    }
}
