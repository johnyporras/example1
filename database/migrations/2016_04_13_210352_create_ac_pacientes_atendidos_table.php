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
			$table->increments('id');
			$table->integer('tipo_autorizacion')->unsigned();
			$table->integer('cedula_afiliado')->index();
			$table->string('clave');
			$table->integer('id_clave_detalle');
			$table->date('fecha_atencion');
			$table->string('patologia');
			$table->text('observaciones');
            $table->timestamps();
            $table->softDeletes();

            	$table->foreign('tipo_autorizacion')->references('id')->on('ac_tipo_autorizacion')
                ->onUpdate('cascade')->onDelete('cascade');
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
