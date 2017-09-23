<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcCuentaplanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_cuentaplan', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_cuenta')->nullable();
			$table->integer('id_plan')->nullable();
			$table->float('costo', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_cuentaplan');
	}

}
