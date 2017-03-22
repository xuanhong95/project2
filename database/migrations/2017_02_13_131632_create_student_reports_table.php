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
            $table->integer('id_allocation')->unsigned();
            $table->foreign('id_allocation')->references('id')->on('allocations');
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
