<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale', function (Blueprint $table) {
            $table->id('sale_id');
            $table->integer('product_id');
            $table->string('sale_name');
            $table->string('sale_img');
            $table->string('sale_time');
            $table->integer('sale_percent');
            $table->integer('sale_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale', function (Blueprint $table) {
            //
        });
    }
}
