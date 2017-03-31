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
            $table->integer('estado_id')->unsigned();
            $table->integer('afiliado_id')->unsigned();
            $table->string('ciudad')->nullable();
            $table->string('contacto', 20)->nullable();
            $table->integer('cobertura')->nullable();
            $table->integer('metodo_id')->unsigned();
            $table->integer('plazo')->nullable();
            $table->string('doc_cedula')->nullable();
            $table->string('doc_acta')->nullable();
            $table->integer('creador')->unsigned(); 
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('estado_id')
                        ->references('es_id')->on('ac_estados')
                        ->onUpdate('CASCADE');
                $table->foreign('afiliado_id')
                        ->references('id')->on('ac_afiliados')
                        ->onUpdate('CASCADE');
                $table->foreign('metodo_id')
                        ->references('id')->on('metodo_pago')
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
