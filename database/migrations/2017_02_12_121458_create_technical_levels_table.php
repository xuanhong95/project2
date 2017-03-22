<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnicalLevelsTable extends Migration
{
    /**THis is managed by Students
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technical_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_allocation')->unsigned();
            $table->foreign('id_allocation')->references('id')->on('allocations');
            $table->integer('criteria_id')->unsigned();
            $table->foreign('criteria_id')->references('id')->on('technical_level_criterias');
            $table->integer('point_id')->unsigned();
            $table->foreign('point_id')->references('id')->on('points');
            $table->string('comment',100);
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
        Schema::drop('technical_levels');
    }
}
