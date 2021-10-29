<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocallevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locallevels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locallevelname')->unique();
            // $table->string('slug')->unique();
            $table->unsignedSmallInteger('province_id')->nullable();
            $table->unsignedSmallInteger('district_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces'); 
            $table->foreign('district_id')->references('id')->on('districts'); 
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
        Schema::dropIfExists('locallevels');
    }
}
