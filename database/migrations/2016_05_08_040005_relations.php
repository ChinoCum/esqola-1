<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Relations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rltn_user_grade', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
        });

        Schema::table('rltn_grade_course', function(Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        Schema::table('rltn_grade_events', function(Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });

        Schema::table('user_settings', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('contents', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });

        Schema::table('homeworks', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });

        Schema::table('score', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('homework_id')->references('id')->on('units')->onDelete('cascade');
        });

        Schema::table('user_attributes', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('rltn_user_grade', function(Blueprint $table) {
            $table->dropForeign('rltn_user_grade_user_id_foreign');
            $table->dropForeign('rltn_user_grade_grade_id_foreign');
        });

        Schema::table('rltn_grade_course', function(Blueprint $table) {
            $table->dropForeign('rltn_grade_course_grade_id_foreign');
            $table->dropForeign('rltn_grade_course_course_id_foreign');
        });

        Schema::table('rltn_grade_events', function(Blueprint $table) {
            $table->dropForeign('rltn_grade_events_grade_id_foreign');
            $table->dropForeign('rltn_grade_events_event_id_foreign');
        });

        Schema::table('user_settings', function(Blueprint $table) {
            $table->dropForeign('user_settings_user_id_foreign');
        });

        Schema::table('contents', function(Blueprint $table) {
            $table->dropForeign('contents_user_id_foreign');
            $table->dropForeign('contents_grade_id_foreign');
            $table->dropForeign('contents_course_id_foreign');
            $table->dropForeign('contents_unit_id_foreign');
        });

        Schema::table('homeworks', function(Blueprint $table) {
            $table->dropForeign('homeworks_user_id_foreign');
            $table->dropForeign('homeworks_grade_id_foreign');
            $table->dropForeign('homeworks_course_id_foreign');
            $table->dropForeign('homeworks_unit_id_foreign');
        });

        Schema::table('score', function(Blueprint $table) {
            $table->dropForeign('score_user_id_foreign');
            $table->dropForeign('score_course_id_foreign');
            $table->dropForeign('score_unit_id_foreign');
            $table->dropForeign('score_homework_id_foreign');
        });

        Schema::table('user_attributes', function(Blueprint $table) {
            $table->dropForeign('user_attributes_user_id_foreign');
            $table->dropForeign('user_attributes_grade_id_foreign');
        });
    }
}
