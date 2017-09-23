<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcBaremosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ac_baremos', function(Blueprint $table)
		{
			$table->foreign('id_procedimiento', 'ac_baremos_ibfk_1')->references('id')->on('ac_procedimientos_medicos')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_proveedor', 'ac_baremos_ibfk_2')->references('codigo_proveedor')->on('ac_proveedores_extranet')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ac_baremos', function(Blueprint $table)
		{
			$table->dropForeign('ac_baremos_ibfk_1');
			$table->dropForeign('ac_baremos_ibfk_2');
		});
	}

}
