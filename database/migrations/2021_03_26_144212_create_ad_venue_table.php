<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdVenueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_venue', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
           
            $table->unsignedInteger('ad_id')->nullable();;
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');

         
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
        Schema::dropIfExists('ad_venue');
    }
}
