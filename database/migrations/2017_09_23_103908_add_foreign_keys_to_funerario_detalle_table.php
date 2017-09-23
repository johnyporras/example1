<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFunerarioDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('funerario_detalle', function(Blueprint $table)
		{
			$table->foreign('funerario_id')->references('id')->on('funerario')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('proveedor_id')->references('id')->on('proveedor_funerario')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('funerario_detalle', function(Blueprint $table)
		{
			$table->dropForeign('funerario_detalle_funerario_id_foreign');
			$table->dropForeign('funerario_detalle_proveedor_id_foreign');
		});
	}

}
