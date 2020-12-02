<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


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
        $category = ProductCategory::pluck('id')->all();
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
            ]
        ];
        $selectedName = $this->faker->randomElement($name);
        $slug = Str::of($selectedName)->slug('-');
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

        return [
            'name'                  => $selectedName,
            'slug'                  => $slug,
            'code'                  => $this->faker->unique()->randomElement($code),
            'retail_price'          => 2000,
            'wholesale_price'       => 3000,
            'color'                 => $this->faker->colorName,
            'size_id'               => $this->faker->randomElement($size),
            'product_category_id'   => $this->faker->randomElement($category),
            'brand_id'              => $this->faker->randomElement($brand),
            'user_id'               => $this->faker->randomElement($userID),

        ];
    }
}
