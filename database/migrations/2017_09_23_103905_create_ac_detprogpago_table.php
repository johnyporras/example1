<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcDetprogpagoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_detprogpago', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_factura')->nullable();
			$table->float('montofact', 10, 0)->nullable();
			$table->float('montoimp1', 10, 0)->nullable();
			$table->float('montoimp2', 10, 0)->nullable();
			$table->float('montoimp3', 10, 0)->nullable();
			$table->integer('estatus')->nullable();
			$table->date('created_at')->nullable();
			$table->date('deleted_at')->nullable();
			$table->integer('id_progpago')->nullable();
			$table->date('updated_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_detprogpago');
	}

}
