<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AppSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * APP SETUP
         */
        Schema::create('user_attributes', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('grade_id')->unsigned()->nullable();
            $table->string('incharge');
            $table->string('incharge_info');
            $table->string('avatar');
            $table->timestamps();
        });

        Schema::create('grades', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',500);
            $table->string('uuid')->nullable();
            $table->timestamps();
        });

        Schema::create('courses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',300);
            $table->string('uuid')->nullable();
            $table->timestamps();
        });

        Schema::create('homeworks', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->string('title',255);
            $table->text('description');
            $table->string('file');
            $table->dateTime('due_date');
            $table->timestamps();
        });

        Schema::create('score', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('homework_id')->unsigned();
            $table->string('title',255);
            $table->decimal('score', 5, 2);
            $table->timestamps();
        });

        Schema::create('comments', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();;
            $table->integer('homework_id')->unsigned();;
            $table->string('comment',255);
            $table->timestamps();
        });

        Schema::create('contents', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->string('title',255);
            $table->text('description');
            $table->string('file_path');
        });

        Schema::create('units', function(Blueprint $table) {
            $table->increments('id');
            $table->string('unit_number');
            $table->string('common_name');
        });

        Schema::create('events', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title',255);
            $table->string('media');
            $table->timestamps();
        });

        Schema::create('user_settings', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();;
            $table->string('configuration');
            $table->timestamps();
        });

        Schema::create('app_configuration', function (Blueprint $table) {
            $table->increments('id');
            $table->string('property',255);
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('rltn_user_grade', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();;
            $table->integer('grade_id')->unsigned();;
        });

        Schema::create('rltn_grade_course', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('grade_id')->unsigned();;
            $table->integer('course_id')->unsigned();;
        });

        Schema::create('rltn_grade_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grade_id')->unsigned();;
            $table->integer('event_id')->unsigned();;
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_attributes');
        Schema::drop('grades');
        Schema::drop('courses');
        Schema::drop('homeworks');
        Schema::drop('score');
        Schema::drop('comments');
        Schema::drop('units');
        Schema::drop('contents');
        Schema::drop('events');
        Schema::drop('user_settings');
        Schema::drop('app_configuration');
        Schema::drop('rltn_user_grade');
        Schema::drop('rltn_grade_course');
        Schema::drop('rltn_grade_events');
    }
}
