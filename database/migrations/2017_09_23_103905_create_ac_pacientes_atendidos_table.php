<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcPacientesAtendidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_pacientes_atendidos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('tipo_autorizacion');
			$table->string('cedula_afiliado', 20);
			$table->string('clave');
			$table->integer('id_clave_detalle');
			$table->date('fecha_atencion');
			$table->string('patologia');
			$table->string('observaciones')->nullable();
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
		Schema::drop('ac_pacientes_atendidos');
	}

}
