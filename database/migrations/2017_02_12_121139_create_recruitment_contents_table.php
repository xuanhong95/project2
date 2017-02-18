<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recruitment_id')->unsigned();
            $table->foreign('recruitment_id')->references('id')->on('recruitments');
            $table->string('role');
            $table->text('jobDescription');
            $table->text('requirement');
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
        Schema::drop('recruitment_contents');
    }
}
