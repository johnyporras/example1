<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcProveedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ac_proveedores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('codigo_proveedor', 30)->unique();
			$table->string('cedula', 100)->unique();
			$table->string('nombre', 100)->nullable();
			$table->integer('codigo_especialidad')->nullable();
			$table->text('direccion')->nullable();
			$table->string('telefono', 20)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('tipo_cuenta', 50)->nullable();
			$table->string('numero_cuenta', 50)->nullable();
			$table->integer('estado_id')->unsigned();
			$table->string('ciudad', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            	$table->foreign('estado_id')->references('id')->on('ac_estados')
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
		Schema::drop('ac_proveedores');
	}

}
