<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAviTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avi', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('codigo_solicitud', 30)->unique('avi_codigo_solicitud_key');
			$table->integer('cedula_afiliado');
			$table->integer('codigo_contrato');
			$table->string('cobertura_monto', 20);
			$table->integer('edad_afiliado');
			$table->string('nro_cronograma', 20);
			$table->text('observaciones')->nullable();
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
		Schema::drop('avi');
	}

}
