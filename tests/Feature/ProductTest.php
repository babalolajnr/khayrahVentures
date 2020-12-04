<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Arr;

class ProductTest extends TestCase
{
    public function testProductStoreMethod()
    {
        $user = User::factory()->create();
        $brand = Brand::pluck('name')->all();
        $brandName = Arr::random($brand);
        $size = Size::pluck('name')->all();
        $sizeName = Arr::random($size);
        $productCategory = ProductCategory::pluck('name')->all();
        $productCategory = Arr::random($productCategory);

        $request = $this->actingAs($user)->post('/submitNewProduct', [
            'name'              => 'Vita Galaxy',
            'code'              => 'M9SH10',
            'productCategory'   => $productCategory,
            'color'             => 'darkslateblue',
            'wholesale'         => '7000',
            'retail'            => '10000',
            'size'              => $sizeName,
            'brand'             => $brandName,
        ]);

        $request->assertStatus(302)->assertSessionHasNoErrors();
        
    }

    public function testProductStoreMethodValidationWorks()
    {
        $user = User::factory()->create();
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
}
