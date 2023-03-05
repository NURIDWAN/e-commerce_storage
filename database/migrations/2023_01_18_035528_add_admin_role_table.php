<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('brand')->nullable();
            $table->string('category')->nullable();
            $table->string('product')->nullable();
            $table->string('slider')->nullable();
            $table->string('coupon')->nullable();
            $table->string('shipping')->nullable();
            $table->string('orders')->nullable();
            $table->string('return')->nullable();
            $table->string('review')->nullable();
            $table->string('stock')->nullable();
            $table->string('alluser')->nullable();
            $table->string('adminrole')->nullable();
            $table->string('reports')->nullable();
            $table->string('setting')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
