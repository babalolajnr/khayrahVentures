<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class InventoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $quantity = mt_rand(0,100);
        $product = Product::pluck('id')->all();
        $productID = $this->faker->unique()->randomElement($product);
        $user = User::pluck('id')->all();
        $userID = Arr::random($user);
        return [
            'quantity' => $quantity,
            'products_id' => $productID,
            'user_id' => $userID
        ];
    }
}
