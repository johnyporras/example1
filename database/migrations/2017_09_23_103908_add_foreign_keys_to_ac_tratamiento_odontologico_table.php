<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcTratamientoOdontologicoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ac_tratamiento_odontologico', function(Blueprint $table)
		{
			$table->foreign('estatus', 'ac_tratamiento_odonto_ibfk_1')->references('id')->on('ac_estatus_detalle')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_clave', 'ac_tratamiento_odonto_ibfk_2')->references('id')->on('ac_clave_odontologica')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_procedimiento', 'ac_tratamiento_odonto_ibfk_3')->references('id')->on('ac_procedimientos_medicos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_diente', 'ac_tratamiento_odonto_ibfk_4')->references('id')->on('ac_diente')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_ubicacion', 'ac_tratamiento_odonto_ibfk_5')->references('id')->on('ac_ubicacion_tratamiento')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ac_tratamiento_odontologico', function(Blueprint $table)
		{
			$table->dropForeign('ac_tratamiento_odonto_ibfk_1');
			$table->dropForeign('ac_tratamiento_odonto_ibfk_2');
			$table->dropForeign('ac_tratamiento_odonto_ibfk_3');
			$table->dropForeign('ac_tratamiento_odonto_ibfk_4');
			$table->dropForeign('ac_tratamiento_odonto_ibfk_5');
		});
	}

}
