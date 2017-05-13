<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**Made by student
     * Confirmed by Internship Manager
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('system&network_skill')->nullable();
            $table->string('special_certificate')->nullable();
            $table->string('soft_skill')->nullable();
            $table->string('other_description')->nullable();
            $table->text('wished_skill')->nullable();
            $table->integer('season');
            $table->boolean('is_confirmed')->nullable();
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
        Schema::drop('registrations');
    }
}
