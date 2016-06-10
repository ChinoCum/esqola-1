<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Errors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('errors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('error',255);
            $table->text('description');
            $table->integer('type')->unsigned();
            $table->timestamps();
        });

        Schema::create('error_types', function (Blueprint $table){
            $table->increments('id');
            $table->string('error_name', 255);
            $table->timestamps();
        });

        Schema::table('errors', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('type')->references('id')->on('error_types');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('errors', function (Blueprint $table) {
            $table->dropForeign('errors_user_id_foreign');
            $table->dropForeign('errors_type_foreign');
        });
        Schema::drop('error_types');
        Schema::drop('errors');
    }
}
