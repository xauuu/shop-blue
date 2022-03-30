<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_roles', function (Blueprint $table) {
            $table->id('id_admin_roles');
            $table->unsignedBigInteger('admin_admin_id');
            $table->unsignedBigInteger('roles_id_roles');
            $table->foreign('admin_admin_id')->references('admin_id')->on('admin')->onDelete('cascade');
            $table->foreign('roles_id_roles')->references('id_roles')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_roles', function (Blueprint $table) {
            //
        });
    }
}
