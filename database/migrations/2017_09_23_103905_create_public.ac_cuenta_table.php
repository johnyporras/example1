<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePublic.acCuentaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('public.ac_cuenta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('codigo_cuenta', 50)->nullable();
			$table->date('fecha')->nullable();
			$table->string('estatus', 2)->nullable();
			$table->integer('id_producto')->nullable();
			$table->integer('id_plan')->nullable();
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
		Schema::drop('public.ac_cuenta');
	}

}
