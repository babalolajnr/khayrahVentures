<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::pluck('id')->all();
        $productArrayLength = count($product);

        //get a user that is an admin
        $user = User::whereHas('userType', function ($q) {
            $q->where('name', 'Admin');
        })->pluck('id')->all();

        
        for ($i = 0; $i < $productArrayLength; $i++) {
            $quantity = mt_rand(0, 100);
            $userID = Arr::random($user);

            Inventory::UpdateorCreate([
                'products_id' => $product[$i]
            ], [
                'quantity'  => $quantity,
                'user_id'   => $userID
            ]);
        }
    }
}
