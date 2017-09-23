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
			$table->integer('id', true);
			$table->integer('id_carta')->index('id1_carta_aval');
			$table->integer('codigo_servicio');
			$table->integer('codigo_especialidad');
			$table->integer('id_procedimiento');
			$table->integer('codigo_proveedor');
			$table->decimal('costo', 10);
			$table->string('detalle', 100)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('estatus')->nullable();
			$table->index(['codigo_servicio','codigo_especialidad','id_procedimiento'], 'id2_carta_aval_procedimiento');
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
