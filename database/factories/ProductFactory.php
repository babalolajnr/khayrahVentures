<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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

        return [
            'name'                  => 'Vita Grand',
            'slug'                  => 'vita-grand',
            'code'                  => 'M1VS',
            'retail_price'          => 2000,
            'wholesale_price'       => 3000,
            'color'                 => $this->faker->colorName,
            'size_id'               => 1,
            'product_category_id'   => 1,
            'brand_id'              => 1,
            'user_id'               => $this->faker->randomElement($userID),

        ];
    }
}
