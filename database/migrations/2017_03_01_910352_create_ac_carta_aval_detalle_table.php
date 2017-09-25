<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcCartaAvalDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_carta_aval_detalle', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_carta')->unsigned();
			$table->integer('codigo_servicio')->unsigned();
			$table->integer('codigo_especialidad')->unsigned();
			$table->integer('id_procedimiento')->unsigned();
			$table->integer('codigo_proveedor')->unsigned();
			$table->double('costo')->nulleable();
			$table->text('detalle', 65535)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('estatus')->unsigned();

            	$table->foreign('id_carta')->references('id')->on('ac_carta_aval')
                ->onUpdate('cascade')->onDelete('cascade');
            	$table->foreign('codigo_servicio')->references('codigo_servicio')->on('ac_servicios_extranet')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('codigo_especialidad')->references('codigo_especialidad')->on('ac_especialidades_extranet')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('id_procedimiento')->references('id')->on('ac_procedimientos_medicos')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('codigo_proveedor')->references('codigo_proveedor')->on('ac_proveedores_extranet')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('estatus')->references('id')->on('ac_estatus_detalle')
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
		Schema::drop('ac_carta_aval_detalle');
	}

}
