<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAppreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_appreciations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_allocation')->unsigned();
            $table->foreign('id_allocation')->references('id')->on('allocations');
            $table->string('general_appreciation_id',1);
            $table->boolean('is_continue_receive')->default(true);
            $table->string('missing_knownledge')->nullable();
            $table->string('necessary_knownledge')->nullable();
            $table->boolean('is_language_necessary')->default(true);
            $table->boolean('is_language_met')->default(true);
            $table->string('shortcoming')->nullable();
            $table->string('advantage')->nullable();
            $table->string('procedure_improvement')->nullable();
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
        Schema::drop('company_appreciations');
    }
}
