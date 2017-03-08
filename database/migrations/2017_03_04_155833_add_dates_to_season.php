<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesToSeason extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('seasons',function(Blueprint $table){
            $table->date('register_deadline');
            $table->date('submit_result_deadline');
            $table->date('remarking_deadline');
            $table->boolean('is_openning')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('seasons', function( Blueprint $table){
            $table->boolean('is_open')->default(false);
        });
    }
}
