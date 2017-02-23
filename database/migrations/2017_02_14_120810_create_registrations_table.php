<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
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
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('season')->unsigned();
            $table->foreign('season')->references('id')->on('seasons');
            $table->string('system&network_skill',100)->nullable();
            $table->string('specialityCertificate',100)->nullable();
            $table->string('softSkill',100)->nullable();
            $table->string('otherDescription',100)->nullable();
            $table->string('wishedSkill',100)->nullable();
            $table->boolean('is_company_confirm')->default(false);
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
