<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcDienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_diente', function(Blueprint $table)
		{
			$table->integer('id')->primary('ac_diente_pkey');
			$table->string('descripcion', 300)->nullable();
			$table->integer('orden');
			$table->integer('cuadrante');
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
		Schema::drop('ac_diente');
	}

}
