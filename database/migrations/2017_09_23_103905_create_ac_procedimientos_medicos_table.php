<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcProcedimientosMedicosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_procedimientos_medicos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('codigo_examen');
			$table->integer('codigo_especialidad');
			$table->integer('codigo_servicio');
			$table->string('tipo_examen', 100);
			$table->timestamps();
			$table->softDeletes();
			$table->unique(['codigo_examen','codigo_especialidad','codigo_servicio'], 'ac_procedimiento_medico_unq');
			$table->index(['codigo_examen','codigo_especialidad','codigo_servicio'], 'idx2_procedimientos_medicos');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_procedimientos_medicos');
	}

}
