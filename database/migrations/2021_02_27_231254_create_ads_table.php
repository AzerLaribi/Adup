<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('status')->default(0);
            $table->integer('type')->nullable();
            $table->string('title')->nullable();;
            $table->string('description')->nullable();;
            $table->string('imageUrl')->nullable();
            $table->string('link')->nullable();
            $table->string('video')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->unsignedInteger('priority')->nullable();
            $table->unsignedInteger('time')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('owner')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
