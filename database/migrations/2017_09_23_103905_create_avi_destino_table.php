<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAviDestinoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avi_destino', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('avi_id')->nullable();
			$table->date('fecha_desde')->nullable();
			$table->date('fecha_hasta')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('pais_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('avi_destino');
	}

}
