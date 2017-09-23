<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSubmodulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('submodules', function(Blueprint $table)
		{
			$table->foreign('modules_id', 'modules_submodules_fk')->references('id')->on('modules')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('submodules', function(Blueprint $table)
		{
			$table->dropForeign('modules_submodules_fk');
		});
	}

}
