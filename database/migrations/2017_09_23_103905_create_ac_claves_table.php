<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcClavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_claves', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('clave', 100)->unique('uc_clave');
			$table->string('cedula_afiliado', 20)->index('cedula_afiliado');
			$table->integer('codigo_contrato')->nullable()->index('idxc_codigo_contrato');
			$table->date('fecha_cita')->nullable();
			$table->string('motivo', 300)->nullable();
			$table->text('observaciones')->nullable();
			$table->decimal('costo_total', 10)->nullable();
			$table->integer('codigo_proveedor_creador')->nullable();
			$table->string('correo', 100)->nullable();
			$table->text('examen')->nullable();
			$table->integer('estatus_clave')->nullable();
			$table->integer('creador')->nullable();
			$table->string('telefono', 25)->nullable();
			$table->text('rechazo')->nullable();
			$table->integer('tipo_afiliado')->nullable();
			$table->integer('cantidad_servicios')->nullable();
			$table->time('hora_autorizado')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('id_factura')->nullable();
			$table->string('tipoatencion', 1)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_claves');
	}

}
