<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFunerarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funerario', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('codigo_solicitud', 20)->unique();
			$table->integer('estado_id');
			$table->integer('afiliado_id');
			$table->string('ciudad')->nullable();
			$table->string('contacto', 20)->nullable();
			$table->integer('cobertura')->nullable();
			$table->integer('metodo_id');
			$table->integer('plazo')->nullable();
			$table->string('doc_cedula')->nullable();
			$table->string('doc_acta')->nullable();
			$table->integer('creador');
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
		Schema::drop('funerario');
	}

}
