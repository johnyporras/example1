<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcClavesDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ac_claves_detalle', function(Blueprint $table)
		{
			$table->foreign('id_clave', 'ac_claves_detalle_ibfk_1')->references('id')->on('ac_claves')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('codigo_servicio', 'ac_claves_detalle_ibfk_2')->references('codigo_servicio')->on('ac_servicios_extranet')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('codigo_proveedor', 'ac_claves_detalle_ibfk_3')->references('codigo_proveedor')->on('ac_proveedores_extranet')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('codigo_especialidad', 'ac_claves_detalle_ibfk_4')->references('codigo_especialidad')->on('ac_especialidades_extranet')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_procedimiento', 'ac_claves_detalle_ibfk_5')->references('id')->on('ac_procedimientos_medicos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('estatus', 'ac_claves_detalle_ibfk_6')->references('id')->on('ac_estatus_detalle')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ac_claves_detalle', function(Blueprint $table)
		{
			$table->dropForeign('ac_claves_detalle_ibfk_1');
			$table->dropForeign('ac_claves_detalle_ibfk_2');
			$table->dropForeign('ac_claves_detalle_ibfk_3');
			$table->dropForeign('ac_claves_detalle_ibfk_4');
			$table->dropForeign('ac_claves_detalle_ibfk_5');
			$table->dropForeign('ac_claves_detalle_ibfk_6');
		});
	}

}
