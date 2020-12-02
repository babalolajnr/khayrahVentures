<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userID = User::pluck('id')->all();
        return [
            'name'          => $this->faker->unique()->company,
            'short_name'    => $this->faker->unique()->companySuffix,
            'slug'          => 'alslallalalala',
            'user_id'       => $this->faker->randomElement($userID)
            
        ];
    }
}
