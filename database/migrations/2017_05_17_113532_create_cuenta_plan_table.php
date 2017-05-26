<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating roles to users (Many-to-Many)
        Schema::create('ac_cuentaplan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cuenta')->unsigned();
            $table->integer('id_plan')->unsigned();
            $table->double('costo')->nullable();

            $table->foreign('id_cuenta')->references('id')->on('ac_cuenta')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_plan')->references('id')->on('ac_planes_extranet')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ac_cuentaplan');
    }
}