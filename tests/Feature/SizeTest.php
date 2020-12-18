<?php

namespace Tests\Feature;

use App\Models\Size;
use App\Utilities\TestUserGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class SizeTest extends TestCase
{
    public function testSizeEdit()
    {
        $user = TestUserGenerator::generateAnyUser();
        $size = Size::pluck('id')->all();
        $size = Arr::random($size); 

        $request = $this->actingAs($user)->get('/editSize/'.$size);
        $request->assertStatus(200);
        
    }
}
