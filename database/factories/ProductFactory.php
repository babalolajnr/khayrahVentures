<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userID = User::pluck('id')->all();
        $size = Size::pluck('id')->all();
        $brand = Brand::pluck('id')->all();
        $name = [
            [
                'Vita Grand',
                'Vita Shine',
                'Vita Galaxy Classic',
                'Vita Galaxy Orthopeadic',
            ],
            [
                'Fibre Dove Pillow',
                'Pama Pillow',
                'Vitacool',
                'Flamingo',
                'Gazelle',
            ],
            ['Bedsheet']
        ];

        $randomArrayCategory = Arr::random($name);
        if ($randomArrayCategory == $name[0]) {
            /**
             * if the randomly selected array is $name[0]
             * then it is in the mattresses category
             */


            $code = [
                'M1SH',
                'M2SH',
                'M3SH',
                'M4SH',
                'M5SH',
                'M1SH8',
                'M2SH8',
                'M3SH8',
                'M4SH8',
                'M9SH',
                'M10SH',
                'M15SH',
                'M5SH8',
            ];
            $code = $this->faker->unique()->randomElement($code);

            //select a random item from the random array selected earlier
            $selectedName = $this->faker->randomElement($randomArrayCategory);
            $size = $this->faker->randomElement($size);
            $categoryID = ProductCategory::where('name', 'Mattresses')->first();
            $categoryID = $categoryID->id;
        } elseif ($randomArrayCategory == $name[1]) {
             /**
             * if the randomly selected array is $name[1]
             * then it is in the pillows category
             * 
             * pillows don't have a code and size
             */
            $code = null;
            $size = null;
            $selectedName = $this->faker->unique()->randomElement($randomArrayCategory);
            $categoryID = ProductCategory::where('name', 'Pillows')->first();
            $categoryID = $categoryID->id;
        } else {
            /**
             * if the randomly selected array is $name[2]
             * then it is in the bedsheets category
             * 
             * bedsheets don't have a code
             */
            $code = null;
            $size = $this->faker->randomElement($size);
            $selectedName = $this->faker->randomElement($randomArrayCategory);
            $categoryID = ProductCategory::where('name', 'Bedsheets')->first();
            $categoryID = $categoryID->id;
        }

        $slug = Str::of($selectedName)->slug('-');
        $wholesalePrice = $this->faker->randomNumber(6);
        $retailPrice = $wholesalePrice*3/100+$wholesalePrice;
        $inventory = Inventory::pluck('id')->all();

        return [
            'name'                  => $selectedName,
            'slug'                  => $slug,
            'code'                  => $code,
            'wholesale_price'       => $wholesalePrice,
            'retail_price'          => $retailPrice,
            'size_id'               => $size,
            'product_category_id'   => $categoryID,
            'brand_id'              => $this->faker->randomElement($brand),
            'user_id'               => $this->faker->randomElement($userID),
            'inventory_id'          => $this->faker->unique()->randomElement($inventory)
        ];
    }
}
