<?php

namespace Tests\Feature;

use App\Models\User;
use App\Utilities\TestUserGenerator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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
    // use RefreshDatabase;
    use DatabaseTransactions;

    //SEED DATABASE BEFORE RUNNING TESTS
    public function testStoreMethod()
    {

        // $this->withoutExceptionHandling();
        $user = TestUserGenerator::generateAnyUser();

        $response = $this->actingAs($user)->post('/submitNewCategory', [
            'name' => 'Pillows'
        ]);

        $response->assertStatus(302);
    }

    public function testFailedValidationMethod()
    {
        // $this->withoutExceptionHandling();
        $user = TestUserGenerator::generateAnyUser();
        $response = $this->actingAs($user)->post('/submitNewCategory', []);

        $response->assertSessionHasErrors('name');
    }
}
