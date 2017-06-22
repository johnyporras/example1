<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('estatus_cuenta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->timestamps();
        });

        Schema::create('ac_cuenta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_cuenta',30)->unique();
            $table->date('fecha');
            $table->integer('estatus')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('id_producto')->references('id')->on('ac_producto')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('estatus')->references('id')->on('estatus_cuenta')
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
        
        Schema::dropIfExists('ac_cuenta');
        Schema::dropIfExists('estatus_cuenta');
    }
}
