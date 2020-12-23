<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        /**
         * WARNING: The seeder classes have to 
         * follow the exact order in which they are listed here for 
         * there to be no issues.
         * 1. UserTypeSeeder
         * 2. UserSeeder
         * 3. BrandSeeder
         * 4. SizeSeeder
         * 5. ProductCategorySeeder
         * 6. InventorySeeder
         * 7. ProductSeeder
         */
        
        $this->call([
            UserTypeSeeder::class,
            UserSeeder::class,
            BrandSeeder::class,
            SizeSeeder::class,
            ProductCategorySeeder::class,
            InventorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
