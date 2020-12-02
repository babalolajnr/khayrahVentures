<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = $this->faker->unique()->company;
        return [
            'name'          => $name,
            'slug'          => Str::of($name)->slug('-'),
            'user_id'       => $this->faker->randomElement($userID)
        ];
    }
}
