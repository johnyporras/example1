<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcClaveOdontologicasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_clave_odontologica', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('clave', 100);
			$table->integer('tipo_control')->unsinged();
			$table->string('cedula-afiliado', 20)->nullable();
			$table->integer('codigo_contrato')->unsinged();
			$table->date('fecha_atencion1')->nullable();
			$table->date('fecha_atencion2')->nullable();
			$table->date('fecha_atencion3')->nullable();
			$table->string('clave_primaria', 100)->nullable();
			$table->string('motivo')->nullable();
			$table->integer('codigo_proveedor_creador')->nullable();
			$table->integer('estatus')->nullable();
			$table->integer('creador')->nullable();
			$table->string('telefono', 20)->nullable();
			$table->integer('numero_control')->nullable()->comment('control de claves asociadas');
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
		Schema::drop('ac_clave_odontologica');
	}

}