<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcDetprogpagoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ac_detprogpago', function(Blueprint $table)
		{
			$table->foreign('id_progpago', 'fkpr')->references('id')->on('ac_progpago')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ac_detprogpago', function(Blueprint $table)
		{
			$table->dropForeign('fkpr');
		});
	}

}
