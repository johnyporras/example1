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
			$table->string('email');
			$table->date('fecha_nacimiento');
			$table->string('sexo', 10);
			$table->string('telefono', 50)->nullable();
            $table->integer('id_cuenta')->unsigned();
            $table->integer('id_estado')->unsigned();
			$table->string('ciudad')->nullable();
			$table->string('civil')->nullable();
			$table->integer('hijos')->unsigned()->nullable();
			$table->string('ocupacion')->nullable();
			$table->string('idioma')->default('es')->nullable();
			$table->integer('altura')->unsigned()->nullable();
			$table->integer('peso')->unsigned()->nullable();
			$table->string('grupo_sangre')->nullable();
			$table->enum('lentes', ['S', 'N'])->default('N');
			$table->string('condicion_lentes')->comment('Condición uso de lentes')->nullable();
			$table->string('menstruacion')->nullable();
			$table->integer('abortos')->unsigned()->nullable();
			$table->integer('partos')->unsigned()->nullable();
			$table->integer('cesarea')->unsigned()->nullable();
			$table->integer('perdidas')->unsigned()->nullable();
			$table->enum('embarazada', ['S', 'N'])->default('N');
			$table->integer('tiempo_gestacion')->comment('Semanas en gestación')->nullable();
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
