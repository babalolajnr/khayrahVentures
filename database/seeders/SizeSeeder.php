<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\User;
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
        $sizesArrayLength = count($sizes);
        $userID = User::factory()->create()->id;
        for ($i = 0; $i < $sizesArrayLength; $i++) {
            $size = $sizes[$i];
            Size::updateOrCreate(
                [
                    'name' => $size,
                ],
                [
                    'user_id' => $userID

                ]
            );
        }
    }
}
