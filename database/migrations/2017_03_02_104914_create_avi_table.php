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
            $table->integer('afiliado_id')->unsigned();
            $table->string('codigo_solicitud',30)->unique();
            $table->integer('codigo_contrato');
            $table->string('cobertura_monto',20);
            $table->string('nro_cronograma',20);
            $table->text('observaciones');
            $table->integer('creador'); 
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('afiliado_id')->references('id')->on('ac_afiliados')
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
        Schema::dropIfExists('avi');
    }
}
