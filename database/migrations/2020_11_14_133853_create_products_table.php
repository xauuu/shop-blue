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
            $table->increments('product_id');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_tag');
            $table->text('product_desc');
            $table->integer('product_quantity');
            $table->integer('product_sale_quantity');
            $table->integer('product_price');
            $table->integer('product_discount');
            $table->text('product_detail');
            $table->string('product_img');
            $table->integer('product_status');
            $table->string('product_view');
            $table->integer('product_order');
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
