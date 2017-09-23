<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcClavesDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_claves_detalle', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_clave')->index('id1_clave');
			$table->integer('codigo_servicio');
			$table->integer('codigo_especialidad');
			$table->integer('id_procedimiento');
			$table->integer('codigo_proveedor');
			$table->decimal('costo', 10);
			$table->string('detalle', 100)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('estatus')->nullable();
			$table->integer('estado')->nullable();
			$table->string('ciudad', 100)->nullable();
			$table->string('turno', 6)->nullable();
			$table->index(['codigo_servicio','codigo_especialidad','id_procedimiento'], 'id2_clave_procedimiento');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_claves_detalle');
	}

}
