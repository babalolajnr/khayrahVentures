<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userType = UserType::first();
        if (is_null($userType)) {
            Artisan::call('db:seed', ['UserTypeSeeder']);
        }
        $userType = UserType::pluck('id')->all();
        $userType = Arr::random($userType);
        return [
            'firstname'         => $this->faker->firstName('male'),
            'lastname'          => $this->faker->lastName,
            'phone_number'      => $this->faker->unique()->phoneNumber,
            'user_type_id'      => $userType,
            'email'             => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password'          => Hash::make("password"), // password
            'remember_token'    => Str::random(10),
        ];
    }
}
