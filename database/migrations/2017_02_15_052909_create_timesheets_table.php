<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesheetsTable extends Migration
{
    /**made by Enterprise Instructors
     * Confirmed ny student and Instructor Teachers
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('work_content',50);
            $table->smallInteger('month');
            $table->string('enough_time')->nullable();
            $table->string('overtime')->nullable();
            $table->string('sick_leave')->nullable();
            $table->string('leave')->nullable();
            $table->string('absent_without_leave')->nullable();
            $table->string('other')->nullable();
            $table->boolean('is_student_confirmed')->nullable();
            $table->boolean('is_teacher_confirmed')->nullable();
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
        Schema::drop('timesheets');
    }
}
