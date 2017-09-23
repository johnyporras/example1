<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcTratamientoOdontologicoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_tratamiento_odontologico', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_clave');
			$table->integer('id_procedimiento');
			$table->integer('id_diente');
			$table->integer('id_ubicacion');
			$table->date('fecha_atencion');
			$table->string('observaciones', 300)->nullable();
			$table->integer('estatus');
			$table->integer('creador');
			$table->string('telefono', 20);
			$table->string('doc1', 300)->nullable();
			$table->string('doc2', 300)->nullable();
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
		Schema::drop('ac_tratamiento_odontologico');
	}

}
