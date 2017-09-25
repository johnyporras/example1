<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tipo_medicamento')->unsigned();
            $table->integer('id_afiliado')->unsigned();
            $table->string('nombre')->nullable();
            $table->integer('dosis')->nullable();
            $table->string('frecuencia')->nullable();
            $table->string('duracion')->nullable();
            $table->string('diagnostico')->nullable();
            $table->string('recetado')->nullable();
            $table->string('file')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->time('hora')->nullable();
            $table->text('mensaje')->nullable();
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('id_tipo_medicamento')->references('id')->on('tipo_medicamentos')
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
        Schema::dropIfExists('medicamentos');
    }
}
