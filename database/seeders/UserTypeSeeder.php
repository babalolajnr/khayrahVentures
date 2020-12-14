<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user types
        $userArray = ['Admin', 'Employee'];
        $userArrayLength = count($userArray);

        //loop throught the array to create all the user types available
        for ($i=0; $i < $userArrayLength; $i++) { 
            $user = $userArray[$i];
            UserType::updateOrCreate(['name' => $user]);
        }
    }
}
