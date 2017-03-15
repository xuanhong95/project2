<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentReportsTable extends Migration
{
    /**Made by Students
     *Confirmed by Instructor Teacher and Enterprise Instructor
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('season')->unsigned();
            $table->foreign('season')->references('id')->on('seasons');
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->string('purpose',100);
            $table->string('job_content');
            $table->string('result');
            $table->string('advantage');
            $table->string('shortcoming');
            $table->boolean('is_company_confirmed')->nullable();
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
        Schema::drop('student_reports');
    }
}
