<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAcClavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ac_claves', function(Blueprint $table)
		{
			$table->foreign('estatus_clave', 'ac_claves_ibfk_4')->references('id')->on('ac_estatus')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ac_claves', function(Blueprint $table)
		{
			$table->dropForeign('ac_claves_ibfk_4');
		});
	}

}
