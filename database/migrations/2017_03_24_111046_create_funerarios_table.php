<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunerariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funerario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_solicitud',20)->unique();
            $table->date('fecha_solicitud'); 
            $table->integer('estado_id')->unsigned();
            $table->string('ciudad')->nullable();
            $table->string('nombre_fallecido');
            $table->string('cedula_fallecido');
            $table->string('telefono_titular', 20)->nullable();
            $table->integer('cobertura');
            $table->integer('excedente');
            $table->integer('metodo_id')->unsigned();
            $table->integer('plazo');
            $table->integer('aseguradora_id')->unsigned();
            $table->integer('colectivo_id')->unsigned();
            $table->integer('creador')->unsigned(); 
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('estado_id')
                        ->references('es_id')->on('ac_estados')
                        ->onUpdate('CASCADE');
                $table->foreign('metodo_id')
                        ->references('id')->on('metodo_pago')
                        ->onUpdate('CASCADE');
                $table->foreign('aseguradora_id')
                        ->references('id')->on('ac_aseguradora')
                        ->onUpdate('CASCADE');
                $table->foreign('colectivo_id')
                        ->references('id')->on('ac_colectivos')
                        ->onUpdate('CASCADE');
                $table->foreign('creador')
                        ->references('id')->on('users')
                        ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('funerario');
    }
}
