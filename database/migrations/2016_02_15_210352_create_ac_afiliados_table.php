<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcAfiliadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_afiliados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cedula', 20)->unique();
			$table->string('nombre');
			$table->string('apellido');
			$table->date('fecha_nacimiento');
			$table->string('email');
			$table->string('sexo', 10);
			$table->string('telefono', 50)->nullable();
            $table->integer('id_cuenta')->unsigned();
            $table->integer('id_estado')->unsigned();
			$table->string('ciudad')->nullable();
			$table->enum('embarazada', ['S', 'N'])->default('N');
			$table->integer('tiempo_gestacion')->comment('Semanas')->nullable();
            $table->timestamps();
            $table->softDeletes();
            	$table->foreign('id_cuenta')->references('id')->on('ac_cuenta')
                ->onUpdate('cascade')->onDelete('cascade');
            	$table->foreign('id_estado')->references('id')->on('ac_estados')
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
		Schema::drop('ac_afiliados');
	}
}