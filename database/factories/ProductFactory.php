<?php

namespace Database\Factories;

use App\Models\Brand;
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
            //mattress
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
            $code = $this->faker->randomElement($code);
            $selectedName = $this->faker->randomElement($randomArrayCategory);
            $color = $this->faker->colorName;
            $size = $this->faker->randomElement($size);
            $categoryID = ProductCategory::where('name', 'Mattresses')->first();
            $categoryID = $categoryID->id;
        } elseif ($randomArrayCategory == $name[1]) {
            //pillow
            $code = null;
            $color = null;
            $size = null;
            $selectedName = $this->faker->randomElement($randomArrayCategory);
            $categoryID = ProductCategory::where('name', 'Pillows')->first();
            $categoryID = $categoryID->id;
        } else {
            //bedsheet
            $code = null;
            $size = $this->faker->randomElement($size);
            $color = $this->faker->colorName;
            $selectedName = $this->faker->randomElement($randomArrayCategory);
            $categoryID = ProductCategory::where('name', 'Bedsheets')->first();
            $categoryID = $categoryID->id;
        }

        $slug = Str::of($selectedName)->slug('-');


        return [
            'name'                  => $selectedName,
            'slug'                  => $slug,
            'code'                  => $code,
            'retail_price'          => 2000,
            'wholesale_price'       => 3000,
            'color'                 => $color,
            'size_id'               => $size,
            'product_category_id'   => $categoryID,
            'brand_id'              => $this->faker->randomElement($brand),
            'user_id'               => $this->faker->randomElement($userID),

        ];
    }
}
