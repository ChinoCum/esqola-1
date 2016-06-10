<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * USERS
         */
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('BK',300)->nullable();
            $table->string('name');
            $table->string('lastname');
            $table->integer('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->integer('age')->nullable();
            $table->string('password');
            $table->string('firstaccess')->nullable();
            $table->string('uuid')->nullable();
            $table->rememberToken()->nullable();
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
       Schema::drop('users');
    }
}
