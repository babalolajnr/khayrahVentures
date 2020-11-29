<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignColumnsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('size_id')->nullable()->constrained('sizes')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('product_category_id')->nullable()->constrained('products_category')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('size_id');
            $table->dropColumn('product_category_id');
            $table->dropColumn('brand_id');
            $table->dropColumn('user_id');
        });
    }
}
