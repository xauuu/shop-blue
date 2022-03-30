<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('post_id');
            $table->integer('category_post_id');
            $table->string('post_tilte');
            $table->string('post_slug');
            $table->string('post_img');
            $table->string('post_desc');
            $table->text('post_detail');
            $table->string('post_meta_keywords');
            $table->string('post_meta_desc');
            $table->integer('post_status');
            $table->string('post_view');
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
        Schema::dropIfExists('posts');
    }
}
