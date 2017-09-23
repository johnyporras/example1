<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcFacturasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ac_facturas', function(Blueprint $table)
		{
			$table->foreign('codigo_estatus', 'ac_facturas_ibfk_1')->references('id')->on('ac_estatus')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('codigo_proveedor_creador', 'ac_facturas_ibfk_2')->references('codigo_proveedor')->on('ac_proveedores_extranet')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ac_facturas', function(Blueprint $table)
		{
			$table->dropForeign('ac_facturas_ibfk_1');
			$table->dropForeign('ac_facturas_ibfk_2');
		});
	}

}
