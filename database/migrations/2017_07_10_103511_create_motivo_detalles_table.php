<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotivoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivo_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_motivo')->unsigned();
            $table->integer('id_afiliado')->unsigned();
            $table->string('tipo')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('frecuencia')->nullable();
            $table->string('causa')->nullable();
            $table->date('fecha')->nullable();
            $table->string('tratamiento')->nullable();
            $table->string('profecional')->nullable();
            $table->text('comentarios')->nullable();
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('id_motivo')->references('id')->on('motivos')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('id_afiliado')->references('id')->on('ac_afiliados')
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
        Schema::dropIfExists('motivo_detalles');
    }
}
