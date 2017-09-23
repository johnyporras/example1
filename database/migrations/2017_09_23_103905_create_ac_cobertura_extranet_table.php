<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcCoberturaExtranetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_cobertura_extranet', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_plan')->index('idx2_ac_cobertura_extranet');
			$table->integer('id_servicio');
			$table->integer('id_especialidad');
			$table->integer('id_procedimiento');
			$table->timestamps();
			$table->softDeletes();
			$table->index(['id_servicio','id_especialidad','id_procedimiento'], 'idx4_ac_cobertura_extranet');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_cobertura_extranet');
	}

}
