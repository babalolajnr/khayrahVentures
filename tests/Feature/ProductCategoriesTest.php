<?php

namespace Tests\Feature;

use App\Models\ProductCategory;
use App\Models\User;
use App\Utilities\TestUserGenerator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class ProductCategoriesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // use RefreshDatabase;
    // use DatabaseTransactions;
    use withFaker;

    //SEED DATABASE BEFORE RUNNING TESTS
    public function testStoreMethod()
    {

        // $this->withoutExceptionHandling();
        $user = TestUserGenerator::generateAnyUser();

        $request = $this->actingAs($user)->post('/submitNewCategory', [
            'name' => 'Pillows'
        ]);

        $request->assertStatus(302);
    }

    public function testFailedValidationMethod()
    {
        // $this->withoutExceptionHandling();
        $user = TestUserGenerator::generateAnyUser();
        $request = $this->actingAs($user)->post('/submitNewCategory', []);

        $request->assertSessionHasErrors('name');
    }

    public function testEditProductCategory()
    {
        $user = TestUserGenerator::generateAdminUser();
        $productCategory = ProductCategory::pluck('id')->all();
        $productCategoryID = Arr::random($productCategory);

        $request = $this->actingAs($user)->get('/editProductCategory/'. $productCategoryID);
        $request->assertStatus(200);
    }

    public function testUpdateProductCategory()
    {
        $user = TestUserGenerator::generateAdminUser();
        $productCategory = ProductCategory::pluck('id')->all();
        $productCategoryID = Arr::random($productCategory);

        $request = $this->actingAs($user)->patch('/updateProductCategory/'. $productCategoryID, [
            'name' => $this->faker->word
        ]);

        $request->assertStatus(200);
    }

    public function testNonAdminCannotUpdateProductCategory()
    {
        $user = TestUserGenerator::generateNonAdminUser();
        $productCategory = ProductCategory::pluck('id')->all();
        $productCategoryID = Arr::random($productCategory);

        $request = $this->actingAs($user)->patch('/updateProductCategory/'. $productCategoryID, [
            'name' => $this->faker->word
        ]);

        $request->assertStatus(403);
    }

    public function testAdminCanDeleteProductCategory()
    {
        $user = TestUserGenerator::generateAdminUser();
        $productCategory = ProductCategory::pluck('id')->all();
        $productCategoryID = Arr::random($productCategory);

        $request = $this->actingAs($user)->delete('/deleteProductCategory/'. $productCategoryID);

        $request->assertStatus(200);
    }
}
