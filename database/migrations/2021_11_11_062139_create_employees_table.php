<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employeename')->unique();
            $table->unsignedSmallInteger('province_id')->nullable();
            $table->unsignedSmallInteger('district_id')->nullable();
            $table->unsignedSmallInteger('locallevel_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade'); 
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade'); 
            $table->foreign('locallevel_id')->references('id')->on('locallevels')->onDelete('cascade'); 
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
        Schema::dropIfExists('employees');
    }
}
