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
        $user = User::factory()->create();
        $products = Inventory::where('quantity', '>', 0)->get();
        $product = $products->random();
        $productID = $product->id;

        $request = $this->actingAs($user)->post('/sell', [
            'product_id'            => $productID,
            'quantity'              => 110,
            'customer_firstname'    => $this->faker->firstName(),
            'customer_lastname'     => $this->faker->lastName,
            'customer_phone_number' => $this->faker->e164PhoneNumber,
            'customer_email'        => $this->faker->email,
            'address'               => $this->faker->address
        ]);

        $request->assertStatus(200)->assertSessionHasErrors();
    }
}
