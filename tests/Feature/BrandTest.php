<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use WithFaker;

    public function testEditBrand()
    {
        $userType = UserType::where('name', 'Admin')->first();
        $userType = $userType->id;
        $user = User::factory()->create(['user_type_id' => $userType]);
        $brand = Brand::pluck('id')->all();
        $brandID = Arr::random($brand);

        $request = $this->actingAs($user)->get('/editBrand/'.$brandID);

        $request->assertStatus(200);
        
    }

    public function testAdminCanStoreBrand()
    {
        $userType = UserType::where('name', 'Admin')->first();
        $userType = $userType->id;
        $user = User::factory()->create(['user_type_id' => $userType]);
        
        $request = $this->actingAs($user)->post('/submitNewBrand', [
            'name'=> $this->faker->company
        ]);
        
        $request->assertStatus(302);
    }
}
