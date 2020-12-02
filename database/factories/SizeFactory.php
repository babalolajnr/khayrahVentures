<?php

namespace Database\Factories;

use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SizeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Size::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userID = User::pluck('id')->all();
        return [
            'name'      => '6x6x9',
            'user_id'   => $this->faker->randomElement($userID),
        ];
    }
}
