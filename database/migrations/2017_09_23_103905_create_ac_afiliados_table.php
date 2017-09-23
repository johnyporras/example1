<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcAfiliadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_afiliados', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('cedula', 20)->index('ac_afiliados_i02');
			$table->string('nombre', 500);
			$table->string('apellido', 500);
			$table->date('fecha_nacimiento');
			$table->string('email', 500)->nullable();
			$table->string('sexo', 10);
			$table->string('telefono', 50)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('id_cuenta')->nullable();
			$table->integer('id_estado')->nullable();
			$table->string('ciudad', 100)->nullable();
			$table->string('embarazada', 1)->nullable();
			$table->integer('tiempo_gestacion')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_afiliados');
	}

}
