<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAviDestinoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avi_destino', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('avi_id')->unsigned();
            $table->integer('pais_id')->unsigned();
            $table->date('fecha_desde'); 
            $table->date('fecha_hasta'); 
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('avi_id')
                    ->references('id')->on('avi')
                    ->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('pais_id')
                    ->references('id')->on('paises')
                    ->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('avi_destino');
    }
}
