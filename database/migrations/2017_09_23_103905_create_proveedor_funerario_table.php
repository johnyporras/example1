<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProveedorFunerarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proveedor_funerario', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('codigo')->unique();
			$table->string('razon_social')->nullable();
			$table->string('rif')->nullable();
			$table->text('direccion')->nullable();
			$table->string('telefono', 20)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proveedor_funerario');
	}

}
