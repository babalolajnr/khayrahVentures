<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\User;
use App\Models\UserType;
use App\Utilities\TestUserGenerator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    public function testEditBrand()
    {
        $user = TestUserGenerator::generateAdminUser();
        $brand = Brand::pluck('id')->all();
        $brandID = Arr::random($brand);

        $request = $this->actingAs($user)->get('/editBrand/' . $brandID);

        $request->assertStatus(200);
    }

    public function testAdminCanStoreBrand()
    {
        $user = TestUserGenerator::generateAdminUser();
        $request = $this->actingAs($user)->post('/submitNewBrand', [
            'name' => $this->faker->company
        ]);

        $request->assertStatus(302);
    }

    public function testNonAdminCannotStoreBrand()
    {

        $user =  TestUserGenerator::generateNonAdminUser();
        $request = $this->actingAs($user)->post('/submitNewBrand', [
            'name' => $this->faker->company
        ]);

        $request->assertStatus(403);
    }

    public function testAdminCanUpdateBrand()
    {
        $user = TestUserGenerator::generateAdminUser();
        $brand = Brand::pluck('id')->all();
        $brandID = Arr::random($brand);
        $request = $this->actingAs($user)->patch('/updateBrand/'. $brandID, [
            'name' => $this->faker->company
        ]);

        $request->assertStatus(200);
    }
}
