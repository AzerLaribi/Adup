<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertiserPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser_partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            //----------------personnel information----------------------------------
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email');
            $table->string('post');
            $table->string('password');
            //--------------------Location information----------------------------------
            $table->string('location_name');
            $table->string('location_region');
            $table->string('location_address');
            $table->string('location_secteur');
            $table->string('location_tel');
            $table->string('email_pro')->nullable();
            $table->string('website')->nullable();
            $table->string('social_media')->nullable();
            $table->string('logo');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('advertiser_partners');
    }
}
