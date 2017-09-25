<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcDienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ac_diente', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('descripcion')->nullable();
            $table->integer('orden')->nullable()->unsigned();
            $table->integer('cuadrante')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ac_diente');
    }
}
