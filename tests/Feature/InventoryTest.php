<?php

namespace Tests\Feature;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Arr;

class InventoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     //SEED DATABASE BEFORE RUNNING TESTS

     public function testUserCanViewInventory()
     {
        $user = User::factory()->create();
        // $user= User::find(1);
        $request = $this->actingAs($user)->get('/inventory');
        $request->assertStatus(200);
     }

    public function testAdminCanUpdateInventory()
    {
        $userType = UserType::where('name', 'Admin')->first();
        $userType = $userType->id;
        $user = User::factory()->create(['user_type_id' => $userType]);
        $inventory = Inventory::pluck('id')->all();
        $randomInventoryModel = Arr::random($inventory);

        $request = $this->actingAs($user)->patch('/updateInventory/'.$randomInventoryModel, [
            'quantity' => 30
        ]);

        $request->assertStatus(200);
    }

    public function testNonAdminCannotUpdateInventory()
    {
        $userType = UserType::where('name', '!=', 'Admin')->first();
        $userType = $userType->id;
        $user = User::factory()->create(['user_type_id' => $userType]);
        $inventory = Inventory::pluck('id')->all();
        $randomInventoryModel = Arr::random($inventory);

        $request = $this->actingAs($user)->patch('/updateInventory/'.$randomInventoryModel, [
            'quantity' => 30
        ]);

        $request->assertStatus(403);
    }

}
