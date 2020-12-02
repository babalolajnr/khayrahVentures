<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userID = User::pluck('id')->all();
        $categories = ['Mattresses', 'Pillows', 'Bedsheets', 'Duvets'];
        return [
            'name'      => $this->faker->unique()->randomElement($categories),
            'user_id'   => $this->faker->randomElement($userID)
        ];
    }
}
