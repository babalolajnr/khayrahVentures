<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Mattresses', 'Pillows', 'Bedsheets', 'Duvets'];
        $categoriesArrayLength = count($categories);
        for ($i=0; $i < $categoriesArrayLength; $i++) { 
            $category = $categories[$i];
            $userID = User::factory()->create()->id;
            ProductCategory::updateOrCreate([
                'name' => $category,
                'user_id' => $userID
                ]);
        }
    }
}
