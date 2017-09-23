<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcCartaAvalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_carta_aval', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('clave', 100)->nullable()->unique('uc_clave_carta');
			$table->string('cedula_afiliado', 20);
			$table->integer('codigo_contrato')->index('idx1_codigo_contrato');
			$table->date('fecha_solicitud')->nullable();
			$table->date('fecha_emision')->nullable();
			$table->string('motivo', 300)->nullable();
			$table->string('diagnostico', 300)->nullable();
			$table->decimal('costo_total', 12, 0)->nullable();
			$table->string('documentos', 300)->nullable();
			$table->integer('estatus')->nullable();
			$table->integer('codigo_proveedor_creador')->nullable()->index('idx1_codigo_proveedor');
			$table->integer('creador')->nullable();
			$table->string('telefono', 75)->nullable();
			$table->text('rechazo')->nullable();
			$table->integer('cantidad_servicios')->nullable();
			$table->integer('tipo_afiliado')->nullable();
			$table->dateTime('fecha_autorizacion')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('id_factura')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_carta_aval');
	}

}
