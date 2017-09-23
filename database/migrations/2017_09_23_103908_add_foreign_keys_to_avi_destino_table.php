<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAviDestinoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('avi_destino', function(Blueprint $table)
		{
			$table->foreign('avi_id', 'avi_destino_avi_id_fkey')->references('id')->on('avi')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('pais_id', 'avi_destino_pais_id_fkey')->references('id')->on('paises')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('avi_destino', function(Blueprint $table)
		{
			$table->dropForeign('avi_destino_avi_id_fkey');
			$table->dropForeign('avi_destino_pais_id_fkey');
		});
	}

}
