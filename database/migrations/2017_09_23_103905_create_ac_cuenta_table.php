<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcCuentaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_cuenta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('codigo_cuenta', 50)->nullable();
			$table->date('fecha')->nullable();
			$table->string('estatus', 2)->nullable();
			$table->integer('id_producto')->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->date('deleted_at')->nullable();
			$table->string('pais', 5)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_cuenta');
	}

}
