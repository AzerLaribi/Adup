<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotVenuesrasbarypivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rasbary_venue', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
       
         
            $table->unsignedInteger('rasbary_id');
            $table->foreign('rasbary_id')->references('id')->on('rasbaries');

            $table->unsignedInteger('venue_id');
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venuerasbarie');
    }
}
