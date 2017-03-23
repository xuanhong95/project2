<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentProgrammingLanguagesTable extends Migration
{
    /**THis is managed by Students
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_programming_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('language_id', 5);
            $table->smallInteger('level')->default(1);
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
        Schema::drop('student_programming_languages');
    }
}
