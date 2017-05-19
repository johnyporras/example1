<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcColectivosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_colectivos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('codigo_colectivo')->unique('uac_codigo_colectivo');
			$table->string('nombre', 100)->nullable();
			$table->integer('codigo_aseguradora')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            	$table->foreign('codigo_aseguradora', 'ac_colectivos_ibfk_1')->references('codigo_aseguradora')->on('ac_aseguradora')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_colectivos');
	}

}
