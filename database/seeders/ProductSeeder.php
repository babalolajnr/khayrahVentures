<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Warning: The times() method has to have the same number 
         * as the InventorySeeder class.
         */
        Product::factory()->times(7)->create();
    }
}
