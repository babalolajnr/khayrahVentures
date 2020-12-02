<?php

namespace Database\Seeders;

use App\Models\Size;
use Database\Factories\SizeFactory;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::factory()->create();
    }
}
