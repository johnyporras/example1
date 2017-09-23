<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePublic.trAcClavesDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('public.tr_ac_claves_detalle', function(Blueprint $table)
		{
			$table->integer('id')->nullable();
			$table->integer('id_clave')->nullable();
			$table->integer('codigo_servicio')->nullable();
			$table->integer('codigo_especialidad')->nullable();
			$table->integer('id_procedimiento')->nullable();
			$table->integer('codigo_proveedor')->nullable();
			$table->decimal('costo', 10)->nullable();
			$table->string('detalle', 100)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('estatus')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('public.tr_ac_claves_detalle');
	}

}
