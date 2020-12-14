<?php
namespace App\Utilities;

use App\Models\User;
use App\Models\UserType;

/**
 * This class generates different
 * types of users for runnning different 
 * kinds of tests.
 */

 class TestUserGenerator {


    /**
     * generate an admin user
     * @return mixed
     */
    public static function generateAdminUser()
    {
        $userType = UserType::where('name', 'Admin')->first();
        $userType = $userType->id;
        $user = User::factory()->create(['user_type_id' => $userType]);

        return $user;
    }

    /**
     * generate a non admin user
     * @return mixed
     */
    public static function generateNonAdminUser()
    {
        $userType = UserType::where('name', '!=', 'Admin')->first();
        $userType = $userType->id;
        $user = User::factory()->create(['user_type_id' => $userType]);

        return $user;
    }

    /**
     * generate any type of user 
     * @return mixed
     */
    public static function generateAnyUser()
    {
        $user = User::factory()->create();

        return $user;
    }
 }