<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SuppliersStorea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',70);
            $table->string('description',150)->nullabel();
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('suppliers_category');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('suppliers_stores');
    }
}
