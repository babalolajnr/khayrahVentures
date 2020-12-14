<?php

namespace Tests\Feature;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use App\Utilities\TestUserGenerator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function testSalesStoreMethod()
    {
        // $this->withoutExceptionHandling();

        $user = TestUserGenerator::generateAnyUser();
        $products = Inventory::where('quantity', '>', 0)->get();
        $product = $products->random();
        $productID = $product->id;
        $quantity = $product->quantity;
        $quantity = $quantity - mt_rand(1, $quantity);

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
