<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentEnglishCertificatesTable extends Migration
{
    /**This is managed by Students
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_english_certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('certificate_id')->unsigned();
            $table->foreign('certificate_id')->references('id')->on('english_certificates');
            $table->decimal('point',4,1);
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
        Schema::drop('student_english_certificates');
    }
}
