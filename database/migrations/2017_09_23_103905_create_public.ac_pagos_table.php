<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePublic.acPagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('public.ac_pagos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_pagos')->nullable();
			$table->string('codigo_confirmacion', 100)->nullable();
			$table->float('monto', 10, 0)->nullable();
			$table->date('fecha_pago')->nullable();
			$table->string('estatus', 2)->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->date('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('public.ac_pagos');
	}

}
