<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcProductoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_producto', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 150)->nullable();
			$table->float('costo', 10, 0)->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->date('deleted_at')->nullable();
			$table->float('costo2', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_producto');
	}

}
