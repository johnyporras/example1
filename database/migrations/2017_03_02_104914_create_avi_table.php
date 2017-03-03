<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAviTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_solicitud',30)->unique();
            $table->integer('cedula_afiliado');
            $table->integer('codigo_contrato');
            $table->string('cobertura_monto',20);
            $table->integer('edad_afiliado'); 
            $table->string('nro_cronograma',20);
            $table->text('observaciones');
            $table->integer('creador'); 
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
        Schema::drop('avi');
    }
}
