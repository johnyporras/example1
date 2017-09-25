<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcClavedetalleprovTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ac_clavedetalleprov', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id_clave')->nullable()->unsigned();
            $table->integer('id_proveedor')->nullable()->unsigned();
            $table->integer('aceptado')->nullable()->unsigned();
            $table->string('observacion')->nullable();
            $table->integer('preferido')->nullable()->unsigned();
            $table->date('fechacita')->nullable();
            $table->string('rangohoracita')->nullable();
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
        Schema::dropIfExists('ac_clavedetalleprov');
    }
}