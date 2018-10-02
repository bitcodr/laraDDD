<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Suppliers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->nullabel();
            $table->string('last_name',150)->nullabel();
            $table->string('cell_phone',15)->nullabel();
            $table->unsignedBigInteger('credit')->default(0);
            $table->string('photo',70)->nullabel();
            $table->string('email',100)->nullabel();
            $table->enum('status',['ACTIVATE','DEACTIVATE'])->nullabel();
            $table->string('username',70)->unique()->index();
            $table->string('password',200);
            $table->string('user_type')->nullabel();
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
        Schema::drop('users');
    }
}
