<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('code')->nullable();
            $table->float('retail_price');
            $table->float('wholesale_price');
            $table->string('color')->nullable();
            $table->foreignId('size_id')->nullable()->constrained('sizes')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('product_category_id')->constrained('products_category')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
