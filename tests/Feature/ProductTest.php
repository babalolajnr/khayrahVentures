<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use App\Models\User;
use App\Models\UserType;
use App\Utilities\TestUserGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    // use RefreshDatabase;
    use DatabaseTransactions;


    public function testProductStoreMethodValidation()
    {
        $user = TestUserGenerator::generateAdminUser();
        $brand = Brand::pluck('name')->all();
        $brandName = Arr::random($brand);
        $size = Size::pluck('name')->all();
        $sizeName = Arr::random($size);
        $productCategory = ProductCategory::pluck('name')->all();
        $productCategory = Arr::random($productCategory);

        $request = $this->actingAs($user)->post('/submitNewProduct', [
            'name'              => '',
            'code'              => '',
            'productCategory'   => $productCategory,
            'wholesale'         => '7000',
            'retail'            => '10000',
            'size'              => $sizeName,
            'brand'             => $brandName,
        ]);

        $request->assertSessionHasErrors();
    }

    public function testAdminCanUpdateProduct()
    {
        $user = TestUserGenerator::generateAdminUser();
        $brand = Brand::pluck('name')->all();
        $brandName = Arr::random($brand);
        $size = Size::pluck('name')->all();
        $sizeName = Arr::random($size);
        $productCategory = ProductCategory::pluck('name')->all();
        $productCategory = Arr::random($productCategory);
        $product = Product::find(1);
        $product = $product->id;

        $request = $this->actingAs($user)->patch('/updateProduct/' . $product, [
            'name'              => 'Vita Supreme',
            'code'              => 'M9SG',
            'productCategory'   => $productCategory,
            'wholesale'         => '7000',
            'retail'            => '10000',
            'size'              => $sizeName,
            'brand'             => $brandName,
        ]);

        $request->assertStatus(302);
    }

    public function testNonAdminCannotUpdateProduct()
    {
        $user = TestUserGenerator::generateNonAdminUser();
        $brand = Brand::pluck('name')->all();
        $brandName = Arr::random($brand);
        $size = Size::pluck('name')->all();
        $sizeName = Arr::random($size);
        $productCategory = ProductCategory::pluck('name')->all();
        $productCategory = Arr::random($productCategory);
        $product = Product::find(1);
        $product = $product->id;

        $request = $this->actingAs($user)->patch('/updateProduct/' . $product, [
            'name'              => 'Vita Supreme',
            'code'              => 'M9SG',
            'productCategory'   => $productCategory,
            'wholesale'         => '7000',
            'retail'            => '10000',
            'size'              => $sizeName,
            'brand'             => $brandName,
        ]);

        $request->assertStatus(403);
    }

    public function testAdminCanCreateProduct()
    {
        $user = TestUserGenerator::generateAdminUser();
        $brand = Brand::pluck('name')->all();
        $brandName = Arr::random($brand);
        $size = Size::pluck('name')->all();
        $sizeName = Arr::random($size);
        $productCategory = ProductCategory::pluck('name')->all();
        $productCategory = Arr::random($productCategory);

        $request = $this->actingAs($user)->post('/submitNewProduct', [
            'name'              => 'Vita Galaxy',
            'code'              => 'M9Sk4',
            'productCategory'   => $productCategory,
            'wholesale'         => '7000',
            'retail'            => '10000',
            'size'              => $sizeName,
            'brand'             => $brandName,
            'quantity'          => 24
        ]);

        $request->assertStatus(302)->assertSessionHasNoErrors();
    }

    public function testNonAdminCannotCreateProduct()
    {
        $user = TestUserGenerator::generateNonAdminUser();
        $brand = Brand::pluck('name')->all();
        $brandName = Arr::random($brand);
        $size = Size::pluck('name')->all();
        $sizeName = Arr::random($size);
        $productCategory = ProductCategory::pluck('name')->all();
        $productCategory = Arr::random($productCategory);

        $request = $this->actingAs($user)->post('/submitNewProduct', [
            'name'              => 'Vita Galaxy',
            'code'              => 'M9SG4',
            'productCategory'   => $productCategory,
            'wholesale'         => '7000',
            'retail'            => '10000',
            'size'              => $sizeName,
            'brand'             => $brandName,
        ]);

        $request->assertStatus(403);
    }

    public function testAdminCanDeleteProduct()
    {
        $user = TestUserGenerator::generateAdminUser();
        $product = Product::factory()->create();
        $productID = $product->id;
        $request = $this->actingAs($user)->delete('/deleteProduct/' . $productID);

        $request->assertStatus(200);
    }

    public function testNonAdminCannotDeleteProduct()
    {
        $user = TestUserGenerator::generateNonAdminUser();
        $product = Product::factory()->create();
        $productID = $product->id;
        $request = $this->actingAs($user)->delete('/deleteProduct/' . $productID);

        $request->assertStatus(403);
    }
}
