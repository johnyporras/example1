<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcPacientesAtendidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ac_pacientes_atendidos', function(Blueprint $table)
		{
			$table->foreign('cedula_afiliado', 'ac_pacientes_atendidos_fk1')->references('cedula')->on('ac_afiliados')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('tipo_autorizacion', 'ac_pacientes_atendidos_fk3')->references('id')->on('ac_tipo_autorizacion')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ac_pacientes_atendidos', function(Blueprint $table)
		{
			$table->dropForeign('ac_pacientes_atendidos_fk1');
			$table->dropForeign('ac_pacientes_atendidos_fk3');
		});
	}

}
