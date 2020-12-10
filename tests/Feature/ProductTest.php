<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use App\Models\User;
use App\Models\UserType;
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
        $userType = UserType::where('name', 'Admin')->first();
        $userType = $userType->id;
        $user = User::factory()->create(['user_type_id' => $userType]);
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
            'color'             => 'darkslateblue',
            'wholesale'         => '7000',
            'retail'            => '10000',
            'size'              => $sizeName,
            'brand'             => $brandName,
        ]);

        $request->assertSessionHasErrors();
    }

    public function testUpdateProductMethod()
    {
        $userType = UserType::where('name', 'Admin')->first();
        $userType = $userType->id;
        $user = User::factory()->create(['user_type_id' => $userType]);
        $brand = Brand::pluck('name')->all();
        $brandName = Arr::random($brand);
        $size = Size::pluck('name')->all();
        $sizeName = Arr::random($size);
        $productCategory = ProductCategory::pluck('name')->all();
        $productCategory = Arr::random($productCategory);
        $product = Product::find(1);
        $product = $product->id;

        $request = $this->actingAs($user)->patch('/updateProduct/'.$product, [
            'name'              => 'Vita Supreme',
            'code'              => 'M9SG',
            'productCategory'   => $productCategory,
            'color'             => 'darkslateblue',
            'wholesale'         => '7000',
            'retail'            => '10000',
            'size'              => $sizeName,
            'brand'             => $brandName,
        ]);

        $request->assertStatus(302);
    }

    public function testAdminCanCreateProduct()
    {
        $userType = UserType::where('name', 'Admin')->first();
        $userType = $userType->id;
        $user = User::factory()->create(['user_type_id' => $userType]);
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
            'color'             => 'darkslateblue',
            'wholesale'         => '7000',
            'retail'            => '10000',
            'size'              => $sizeName,
            'brand'             => $brandName,
        ]);

        $request->assertStatus(302)->assertSessionHasNoErrors();
        

    }

    public function testEmployeeCannotCreateProduct()
    {
        $userType = UserType::where('name', 'Employee')->first();
        $userType = $userType->id;
        $user = User::factory()->create(['user_type_id' => $userType]);
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
            'color'             => 'darkslateblue',
            'wholesale'         => '7000',
            'retail'            => '10000',
            'size'              => $sizeName,
            'brand'             => $brandName,
        ]);

        $request->assertStatus(403);
        

    }
}
