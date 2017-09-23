<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcCartaAvalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ac_carta_aval', function(Blueprint $table)
		{
			$table->foreign('estatus', 'ac_carta_ibfk_5')->references('id')->on('ac_estatus')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ac_carta_aval', function(Blueprint $table)
		{
			$table->dropForeign('ac_carta_ibfk_5');
		});
	}

}
