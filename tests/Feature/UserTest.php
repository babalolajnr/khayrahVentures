<?php

namespace Tests\Feature;

use App\Models\User;
use App\Utilities\TestUserGenerator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // use RefreshDatabase;
    use DatabaseTransactions;
    
    public function testUserLogin()
    {
        $user = TestUserGenerator::generateAnyUser();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }
}
