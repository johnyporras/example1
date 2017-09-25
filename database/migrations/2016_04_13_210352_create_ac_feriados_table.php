<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcFeriadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_feriados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('dia')->nullable();
			$table->integer('mes')->nullable();
			$table->integer('periodo')->nullable();
			$table->date('fecha')->nullable();
			$table->string('descripcion')->nullable();
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
		Schema::dropIfExists('ac_feriados');
	}

}