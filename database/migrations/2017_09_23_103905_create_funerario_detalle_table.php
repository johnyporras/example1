<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFunerarioDetalleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funerario_detalle', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('funerario_id');
			$table->integer('proveedor_id');
			$table->string('factura');
			$table->date('fecha');
			$table->integer('monto');
			$table->text('detalles')->nullable();
			$table->text('doc_factura')->nullable();
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
		Schema::drop('funerario_detalle');
	}

}
