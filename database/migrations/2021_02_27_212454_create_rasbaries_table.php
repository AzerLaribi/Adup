<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRasbariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rasbaries', function (Blueprint $table) {
            $table->increments('id');;
            $table->timestamps();
            $table->string('model')->nullable();
            $table->string('key')->nullable();
            $table->string('name')->nullable();
            $table->date('boughtdate')->nullable();
            $table->date('givingdate')->nullable();
           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rasbaries');
    }
}
