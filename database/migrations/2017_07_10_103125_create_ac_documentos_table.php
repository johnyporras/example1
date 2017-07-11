<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ac_documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tipo_documento')->unsigned();
            $table->integer('id_afiliado')->unsigned();
            $table->string('detalle')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('id_tipo_documento')->references('id')->on('ac_tipo_documentos')
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
        Schema::dropIfExists('ac_documentos');
    }
}
