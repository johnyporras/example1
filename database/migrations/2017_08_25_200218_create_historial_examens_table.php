<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_examenes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_historial')->unsigned();
            $table->string('examen')->nullable();
            $table->timestamps();
                $table->foreign('id_historial')->references('id')->on('historial_medico')
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
        Schema::drop('historial_examenes');
    }
}
