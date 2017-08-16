<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialMedicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_medico', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_proveedor')->unsigned();
            $table->date('fecha')->nullable()->comment('Fecha de Atención');
            $table->string('motivo')->nullable()->comment('Motivo de Atención');
            $table->string('especialidad')->nullable();
            $table->string('tratamiento')->nullable();
            $table->string('procedimiento')->nullable()->comment('Procedimiento o Examen medico realizado');
            $table->text('observaciones')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->string('archivos')->nullable()->comment('Examenes Realizados');
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('id_proveedor')->references('id')->on('ac_proveedores_extranet')
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
        Schema::dropIfExists('historial_medico');
    }
}
