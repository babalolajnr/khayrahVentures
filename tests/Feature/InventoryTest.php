<?php

namespace Tests\Feature;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use App\Models\UserType;
use App\Utilities\TestUserGenerator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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

     use DatabaseTransactions;
     //SEED DATABASE BEFORE RUNNING TESTS

     public function testUserCanViewInventory()
     {
        $user = TestUserGenerator::generateAnyUser();
        $request = $this->actingAs($user)->get('/inventory');
        $request->assertStatus(200);
     }

    public function testAdminCanUpdateInventory()
    {
        $user = TestUserGenerator::generateAdminUser();
        $inventory = Inventory::pluck('id')->all();
        $randomInventoryModel = Arr::random($inventory);

        $request = $this->actingAs($user)->patch('/updateInventory/'.$randomInventoryModel, [
            'quantity' => 30
        ]);

        $request->assertStatus(200);
    }

    public function testNonAdminCannotUpdateInventory()
    {
        $user = TestUserGenerator::generateNonAdminUser();
        $inventory = Inventory::pluck('id')->all();
        $randomInventoryModel = Arr::random($inventory);

        $request = $this->actingAs($user)->patch('/updateInventory/'.$randomInventoryModel, [
            'quantity' => 30
        ]);

        $request->assertStatus(403);
    }

}
