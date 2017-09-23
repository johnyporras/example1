<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcEventosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_eventos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('titulo', 120)->nullable();
			$table->text('descripcion')->nullable();
			$table->integer('id_user')->nullable();
			$table->date('fechainicio')->nullable();
			$table->date('fechafin')->nullable();
			$table->date('created_at')->nullable();
			$table->date('updated_at')->nullable();
			$table->date('deleted_at')->nullable();
			$table->string('hora', 40)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_eventos');
	}

}
