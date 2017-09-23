<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcProveedoresExtranetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_proveedores_extranet', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('codigo_proveedor')->unique('idxp1_codigo_proveedor');
			$table->string('cedula', 100)->nullable();
			$table->string('nombre', 100)->nullable();
			$table->integer('codigo_especialidad')->nullable();
			$table->text('direccion')->nullable();
			$table->string('telefono', 20)->nullable();
			$table->integer('estado_id')->nullable();
			$table->string('ciudad', 100)->nullable();
			$table->string('email', 100)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('tipo_cuenta')->nullable();
			$table->decimal('numero_cuenta', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ac_proveedores_extranet');
	}

}
