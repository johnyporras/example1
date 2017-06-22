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
			$table->increments('id');
			$table->string('clave')->unique();
			$table->string('cedula_afiliado', 20)->index('idx1_cedula_afiliado');
			$table->date('fecha_solicitud')->nullable();
			$table->date('fecha_emision')->nullable();
			$table->string('motivo', 300)->nullable();
			$table->string('diagnostico', 300)->nullable();
			$table->double('costo_total')->nullable();
			$table->string('documentos', 300)->nullable();
			$table->integer('estatus')->nullable()->unsigned();
			$table->string('codigo_proveedor_creador', 100)->nullable()->index('idx1_codigo_proveedor');
			$table->integer('creador')->nullable();
			$table->string('telefono', 75)->nullable();
			$table->text('rechazo', 65535)->nullable();
			$table->integer('cantidad_servicios')->nullable();
			$table->integer('tipo_afiliado')->nullable();
			$table->date('fecha_autorizacion')->nullable();
			$table->integer('id_factura')->nullable();
				$table->timestamps();
	            $table->softDeletes();
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