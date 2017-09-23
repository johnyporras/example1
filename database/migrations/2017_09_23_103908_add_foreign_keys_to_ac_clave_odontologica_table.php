<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcClaveOdontologicaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ac_clave_odontologica', function(Blueprint $table)
		{
			$table->foreign('estatus', 'ac_clave_odontologica_ibfk_1')->references('id')->on('ac_estatus')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('creador', 'ac_clave_odontologica_ibfk_2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('codigo_proveedor_creador', 'ac_clave_odontologica_ibfk_3')->references('codigo_proveedor')->on('ac_proveedores_extranet')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('tipo_control', 'ac_clave_odontologica_ibfk_4')->references('id')->on('ac_tipo_control')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('cedula_afiliado', 'ac_clave_odontologica_ibfk_5')->references('cedula')->on('ac_afiliados')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ac_clave_odontologica', function(Blueprint $table)
		{
			$table->dropForeign('ac_clave_odontologica_ibfk_1');
			$table->dropForeign('ac_clave_odontologica_ibfk_2');
			$table->dropForeign('ac_clave_odontologica_ibfk_3');
			$table->dropForeign('ac_clave_odontologica_ibfk_4');
			$table->dropForeign('ac_clave_odontologica_ibfk_5');
		});
	}

}
