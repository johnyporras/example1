<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcCoberturaExtranetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ac_cobertura_extranet', function(Blueprint $table)
		{
			$table->foreign('id_plan', 'ac_aseguradora_ibfk_1')->references('codigo_plan')->on('ac_planes_extranet')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_servicio', 'ac_cobertura_extranet_ibfk_3')->references('codigo_servicio')->on('ac_procedimientos_medicos')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ac_cobertura_extranet', function(Blueprint $table)
		{
			$table->dropForeign('ac_aseguradora_ibfk_1');
			$table->dropForeign('ac_cobertura_extranet_ibfk_3');
		});
	}

}
