<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFunerarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('funerario', function(Blueprint $table)
		{
			$table->foreign('afiliado_id')->references('id')->on('ac_afiliados')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('creador')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('estado_id')->references('id')->on('ac_estados')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('metodo_id')->references('id')->on('metodo_pago')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('funerario', function(Blueprint $table)
		{
			$table->dropForeign('funerario_afiliado_id_foreign');
			$table->dropForeign('funerario_creador_foreign');
			$table->dropForeign('funerario_estado_id_foreign');
			$table->dropForeign('funerario_metodo_id_foreign');
		});
	}

}
