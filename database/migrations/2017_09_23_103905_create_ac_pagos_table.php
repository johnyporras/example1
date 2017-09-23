<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcPagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_pagos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_cuenta')->nullable();
			$table->date('fechacorte')->nullable();
			$table->float('monto', 10, 0)->nullable();
			$table->date('fechapago')->nullable();
			$table->time('hora')->nullable();
			$table->string('codtransaccion', 150)->nullable();
			$table->char('modpago', 2)->nullable();
			$table->integer('estatuspago')->nullable();
			$table->string('observacion')->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->string('detpago')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_pagos');
	}

}
