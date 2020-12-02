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
        $sizes = [
            '75inx54inx6in',
            '75inx48inx6in',
            '75inx42inx6in',
            '75inx36inx6in',
            '75inx54inx8in',
            '75inx54inx8in',
            '75inx48inx8in',
            '75inx42inx8in',
            '75inx36inx8in',
            '75inx36inx4in',
            '75inx30inx4in',
            '75inx30inx3in',
        ];
        return [
            'name'      => $this->faker->unique()->randomElement($sizes),
            'user_id'   => $this->faker->randomElement($userID),
        ];
    }
}
