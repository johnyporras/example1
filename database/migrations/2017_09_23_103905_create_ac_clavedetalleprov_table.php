<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcClavedetalleprovTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_clavedetalleprov', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_clave')->nullable();
			$table->integer('id_proveedor')->nullable();
			$table->integer('aceptado')->nullable();
			$table->string('observacion', 250)->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->integer('preferido')->nullable();
			$table->date('fechacita')->nullable();
			$table->string('rangohoracita', 200)->nullable();
			$table->integer('pendiente')->nullable();
			$table->string('horacita', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_clavedetalleprov');
	}

}
