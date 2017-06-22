<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcCoberturaExtranet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ac_cobertura_extranet', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id_plan')->nullable()->unsigned();
            $table->integer('id_servicio')->nullable()->unsigned();
            $table->integer('id_especialidad')->nullable()->unsigned();
            $table->integer('id_procedimieto')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
                $table->foreign('id_plan')->references('codigo_plan')->on('ac_planes_extranet')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('id_servicio')->references('codigo_servicio')->on('ac_servicios_extranet')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('id_especialidad')->references('codigo_especialidad')->on('ac_especialidades_extranet')
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
        Schema::dropIfExists('ac_cobertura_extranet');
    }

}