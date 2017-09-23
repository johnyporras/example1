<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcClaveOdontologicaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_clave_odontologica', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('clave', 100)->unique('uc_clave_odonto');
			$table->integer('tipo_control');
			$table->string('cedula_afiliado', 20)->index('idxco_cedula_afiliado');
			$table->integer('codigo_contrato')->index('idxco1_codigo_contrato');
			$table->date('fecha_atencion1');
			$table->date('fecha_atencion2')->nullable();
			$table->date('fecha_atencion3')->nullable();
			$table->string('clave_primaria', 100)->nullable();
			$table->string('motivo', 300)->nullable();
			$table->integer('codigo_proveedor_creador');
			$table->integer('estatus');
			$table->integer('creador');
			$table->string('telefono', 20);
			$table->timestamps();
			$table->softDeletes();
			$table->integer('numero_control')->nullable()->comment('control de claves asociadas');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_clave_odontologica');
	}

}
