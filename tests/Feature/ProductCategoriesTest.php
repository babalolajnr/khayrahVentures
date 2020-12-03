<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductCategoriesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    //SEED DATABASE BEFORE RUNNING TESTS
    public function testStoreMethod()
    {

        $user = User::find(1);

        $response = $this->actingAs($user)->post('/submitNewCategory', [
            'name' => 'Pillows'
        ]);

        $response->assertStatus(302);
    }

    public function testFailedValidationMethod()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->post('/submitNewCategory', []);

        $response->assertSessionHasErrors('name');
    }
}
